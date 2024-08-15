<?php

namespace app\validator;

use app\validator\BaseValidator;

class ConfigValidator extends BaseValidator
{
    protected array $scene = [
        'create' => ['name', 'value'],
        'update' => ['name', 'value'],
    ];

    public function rules(): array
    {
        return [
            'name' => ['required', 'alpha_dash', 'unique:config,name'],
            'value' => ['required'],
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => '名称',
            'value' => '值',
        ];
    }
}
