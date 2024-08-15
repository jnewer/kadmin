<?php

namespace app\validator;

use app\validator\BaseValidator;

class DictValidator extends BaseValidator
{
    protected array $scene = [
        'create' => ['name', 'value','status'],
        'update' => ['name', 'value','status'],
    ];

    public function rules(): array
    {
        return [
            'name' => ['required', 'unique:dict'],
            'value' => ['required'],
            'status' => ['required', 'in:0,1'],
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => '名称',
            'value' => '值',
            'status' => '状态',
        ];
    }
}
