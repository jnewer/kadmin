<?php

namespace app\validator;

use app\validator\BaseValidator;
use Illuminate\Validation\Rule;

class DictValidator extends BaseValidator
{
    protected array $scene = [
        'create' => ['name', 'value', 'status'],
        'update' => ['name', 'value', 'status'],
    ];

    public function rules(): array
    {
        return [
            'name' => ['required', $this->modelId ? Rule::unique('dict', 'name')->ignore($this->modelId) : 'unique:dict,name'],
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
