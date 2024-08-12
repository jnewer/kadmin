<?php

namespace app\validator;

use app\validator\BaseValidator;

class AdminValidator extends BaseValidator
{
    protected array $scene = [
        'login' => ['username', 'password'],
        'create' => ['username', 'password', 'email'],
        'update' => ['id', 'username', 'password', 'email'],
        'change_password' => ['id', 'old_password', 'new_password', 'new_password_confirmatiom'],
    ];

    public function rules(): array
    {
        return [
            'username' => ['required', 'alpha_dash', 'between:4,20'],
            'password' => ['required', 'alpha_dash',  'between:6,20'],
            'email' => ['required', 'email'],
            'id' => ['required', 'integer'],
            'old_password' => ['required'],
            'new_password' => ['required', 'alpha_dash', 'between:6,20', 'same:new_password_confirmatiom'],
            'new_password_confirmatiom' => ['required', 'between:6,20'],
        ];
    }

    public function attributes(): array
    {
        return [
            'username' => '用户名',
            'password' => '密码',
            'email' => '邮箱',
            'id' => 'ID',
            'old_password' => '原始密码',
            'new_password' => '新密码',
            'new_password_confirmatiom' => '确认密码',
        ];
    }
}
