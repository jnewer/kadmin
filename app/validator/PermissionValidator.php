<?php

namespace app\validator;

use Illuminate\Validation\Rule;
use app\validator\BaseValidator;

class PermissionValidator extends BaseValidator
{
    protected array $scene = [
        'create' => ['name',  'key', 'pid', 'href', 'type', 'weight'],
        'update' => ['name', 'key', 'pid', 'href', 'type', 'weight'],
    ];

    public function rules(): array
    {
        return [
            'name' => ['required', $this->modelId ? Rule::unique('permission', 'name')->ignore($this->modelId) : 'unique:permissions,name'],
            'key' => ['required'],
            'pid' => ['required', 'exists:permission,id'],
            'href' => ['required'],
            'type' => ['integer'],
            'sort' => ['integer'],
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => '名称',
            'key' => '标识',
            'pid' => '上级菜单',
            'href' => 'url',
            'type' => '类型',
            'sort' => '权重',
        ];
    }
}
