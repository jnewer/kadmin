<?php

namespace app\validator;

use app\validator\BaseValidator;
use Illuminate\Validation\Rule;

class UserValidator extends BaseValidator
{
    protected array $scene = [
        'login' => ['username', 'password'],
        'create' => ['username', 'password', 'email', 'phone', 'status'],
        'update' => ['avatar', 'email', 'phone', 'status'],
        'change_password' => ['old_password', 'new_password', 'new_password_confirmatiom'],
    ];

    public function rules(): array
    {
        return [
            'username' => ['required', 'alpha_dash', 'between:4,20', $this->modelId ? Rule::unique('user', 'username')->ignore($this->modelId) : 'unique:user,username'],
            'password' => ['required', 'alpha_dash',  'between:6,20'],
            'email' => ['required', 'email',  $this->modelId ? Rule::unique('user', 'email')->ignore($this->modelId) : 'unique:user,email'],
            'phone' => ['required', 'regex:/^1\d{10}$/', $this->modelId ? Rule::unique('user', 'phone')->ignore($this->modelId) : 'unique:user,phone'],
            'status' => ['required', 'integer', 'in:0,1'],
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
            'old_password' => '旧密码',
            'new_password' => '新密码',
            'new_password_confirmatiom' => '确认密码',
            'phone' => '手机号',
            'status' => '状态',
        ];
    }
}
