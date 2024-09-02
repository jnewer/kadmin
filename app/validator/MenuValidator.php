<?php

namespace app\validator;

use Illuminate\Validation\Rule;
use app\validator\BaseValidator;

class MenuValidator extends BaseValidator
{
    protected array $scene = [
        'create' => ['name',  'key', 'pid', 'href', 'type', 'sort'],
        'update' => ['name', 'key', 'pid', 'href', 'type', 'sort'],
    ];

    public function rules(): array
    {
        return [
            'name' => ['required', $this->modelId ? Rule::unique('menu', 'name')->ignore($this->modelId) : 'unique:menus,name'],
            'key' => ['required'],
            'pid' => ['required', 'exists:menu,id'],
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
