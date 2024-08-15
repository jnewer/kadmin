<?php

namespace app\validator;

use app\validator\BaseValidator;

class PermissionValidator extends BaseValidator
{
    protected array $scene = [
        'create' => ['title',  'key', 'pid', 'href', 'type', 'weight'],
        'update' => ['title', 'key', 'pid', 'href', 'type', 'weight'],
    ];

    public function rules(): array
    {
        return [
            'title' => ['required', 'unique:permissions,title'],
            'key' => ['required'],
            'pid' => ['required', 'integer'],
            'href' => ['required'],
            'type' => ['integer'],
            'sort' => ['integer'],
        ];
    }

    public function attributes(): array
    {
        return [
            'title' => '标题',
            'key' => '标识',
            'pid' => '上级菜单',
            'href' => 'url',
            'type' => '类型',
            'sort' => '权重',
        ];
    }
}
