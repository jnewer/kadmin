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
}
