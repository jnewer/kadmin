<?php

namespace app\service;

use Tinywan\Jwt\JwtToken;
use app\service\AdminService;
use Illuminate\Support\Facades\Bus;
use support\exception\BusinessException;

class AuthService
{
    /**
     * @param array $params
     * @return array
     */
    public function login(array $params): array
    {
        if (empty($params['username'])) {
            throw new BusinessException('用户名不能为空');
        }

        if (empty($params['password'])) {
            throw new BusinessException('密码不能为空');
        }

        $admin = AdminService::findByUsername($params['username']);
        if (is_null($admin)) {
            throw new BusinessException('用户名或密码错误');
        }

        $extend = [
            'id'  => $admin->id,
            'username'  => $admin->username,
            'email' => $admin->email,
            'client' => 'WEB'
        ];

        return JwtToken::generateToken($extend);
    }

    public function logout()
    {
        return JwtToken::clear();
    }

    public static function canAccess($adminId, $controller, $action, $path)
    {
        $admin = AdminService::instance()->findModel($adminId);

        // if ($admin->isAdmin()) {
        //     return true;
        // }

        // 控制器里有access方法，则调用access方法判断是否有权限
        if (method_exists($controller, 'access')) {
            $access = $controller->access();

            if (!empty($access) && !in_array($action, $access['exceptAuth'])) {
                return true;
            }
        }

        // 没有角色
        if (!$admin->hasRole()) {
            return false;
        }

        $permissions = AdminService::instance()->getPermissions($admin->id);

        $dotPath = str_replace('/', '.', $path);

        // 如果action为index，规则里有任意一个以$controller开头的权限即可
        if (strtolower($action) === 'index') {
            $permissionLike = str_replace('/', '.', $dotPath);
            $found = array_map(function ($permission) use ($permissionLike) {
                return strpos($permission, $permissionLike)!== false;
            }, $permissions);

            return !!$found;
        }

        return in_array($dotPath, $permissions);
    }
}
