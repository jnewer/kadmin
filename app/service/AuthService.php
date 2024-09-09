<?php

namespace app\service;

use Tinywan\Jwt\JwtToken;
use app\service\UserService;
use support\exception\BusinessException;

class AuthService
{
    public function login(array $params): array
    {
        $this->validateLoginParams($params);

        $user = UserService::findByUsername($params['username']);
        if (!$user) {
            throw new BusinessException('用户名或密码错误');
        }

        $extend = [
            'id' => $user->id,
            'username' => $user->username,
            'email' => $user->email,
            'client' => 'WEB'
        ];

        return [
            'user' => $user,
            'token' => JwtToken::generateToken($extend)
        ];
    }

    public function logout(): bool
    {
        return JwtToken::clear();
    }

    public static function canAccess($controller, $action, $path): bool
    {
        $user = UserService::instance()->findModel(JwtToken::getCurrentId());

        if ($user->isSuperAdmin()) {
            return true;
        }

        if (self::isActionSkipped($controller, $action)) {
            return true;
        }

        if (!$user->hasRole()) {
            return false;
        }

        $permissions = UserService::instance()->getPermissions($user->id);
        $dotPath = str_replace('/', '.', ltrim($path, '/'));

        if (strtolower($action) === 'index') {
            return self::hasPermissionLike($permissions, $dotPath);
        }

        return in_array($dotPath, $permissions);
    }

    private function validateLoginParams(array $params): void
    {
        if (empty($params['username'])) {
            throw new BusinessException('用户名不能为空');
        }

        if (empty($params['password'])) {
            throw new BusinessException('密码不能为空');
        }
    }

    private static function isActionSkipped($controller, $action): bool
    {
        $class = new \ReflectionClass($controller);
        $properties = $class->getDefaultProperties();
        $skipAuth = $properties['skipAuth'] ?? [];
        return in_array($action, $skipAuth);
    }

    private static function hasPermissionLike(array $permissions, string $dotPath): bool
    {
        $permissionLike = substr($dotPath, 0, -5);
        $found = array_filter($permissions, fn($permission) => strpos($permission, $permissionLike) !== false);
        return !empty($found);
    }
}
