<?php

namespace app\service;

use Tinywan\Jwt\JwtToken;
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
}
