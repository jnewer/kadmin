<?php

namespace app\service;

use app\model\User;
use Tinywan\Jwt\JwtToken;
use app\service\UserService;
use support\exception\BusinessException;

class AuthService
{
    public function login(array $params): array
    {
        if (empty($params['username'])) {
            throw new BusinessException('用户名不能为空');
        }

        if (empty($params['password'])) {
            throw new BusinessException('密码不能为空');
        }

        $user = UserService::findByUsername($params['username']);
        if (is_null($user)) {
            throw new BusinessException('用户名或密码错误');
        }

        $extend = [
            'id'  => $user->id,
            'username'  => $user->username,
            'email' => $user->email,
            'client' => 'WEB'
        ];

        return [
            'user' => $user,
            'token' => JwtToken::generateToken($extend)
        ];
    }

    public function logout()
    {
        return JwtToken::clear();
    }

    public static function canAccess($controller, $action, $path)
    {
        /** @var User $user */
        $user = UserService::instance()->findModel(JwtToken::getCurrentId());

        if ($user->isSuperAdmin()) {
            return true;
        }

        // 控制器里有access方法，则调用access方法判断是否有权限
        $class = new \ReflectionClass($controller);
        $properties = $class->getDefaultProperties();
        $skipAuth = $properties['skipAuth'] ?? [];
        if (in_array($action, $skipAuth)) {
            return true;
        }

        // 没有角色
        if (!$user->hasRole()) {
            return false;
        }

        $permissions = UserService::instance()->getPermissions($user->id);

        $dotPath = str_replace('/', '.', ltrim($path, '/'));

        // 如果action为index，规则里有任意一个以$controller开头的权限即可
        if (strtolower($action) === 'index') {
            $permissionLike = substr($dotPath, 0, -5);

            $found = array_filter($permissions, function ($permission) use ($permissionLike) {
                return strpos($permission, $permissionLike) !== false;
            });

            return !empty($found);
        }

        return in_array($dotPath, $permissions);
    }
}
