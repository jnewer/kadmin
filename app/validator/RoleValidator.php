<?php

namespace app\validator;

use app\validator\BaseValidator;
use Illuminate\Validation\Rule;

class RoleValidator extends BaseValidator
{
    protected array $scene = [
        'create' => ['name', 'pid'],
        'update' => ['name', 'pid'],
    ];

    public function rules(): array
    {
        return [
            'name' => ['required', $this->modelId ? Rule::unique('role', 'name')->ignore($this->modelId) : 'unique:role,name'],
            'pid' => ['required', 'exists:role,id'],
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => '名称',
            'pid' => '父级角色',
        ];
    }
}
