<?php

namespace app\validator;

use app\validator\BaseValidator;

class OptionValidator extends BaseValidator
{
    protected array $scene = [
        'create' => ['name', 'value'],
        'update' => ['name', 'value'],
    ];

    public function rules(): array
    {
        return [
            'name' => ['required', 'alpha_dash', 'unique:options,name'],
            'value' => ['required'],
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => '建',
            'value' => '值',
        ];
    }
}
