<?php

namespace app\validator;

use app\validator\BaseValidator;

class RoleValidator extends BaseValidator
{
    protected array $scene = [
        'create' => ['name', 'pid'],
        'update' => ['name', 'pid'],
    ];

    public function rules(): array
    {
        return [
            'name' => ['required', 'unique:role,name'],
            'pid' => ['required', 'exists:role,id'],
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => '角色名称',
            'pid' => '父级角色',
        ];
    }
}
