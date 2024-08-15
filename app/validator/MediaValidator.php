<?php

namespace app\validator;

use app\validator\BaseValidator;

class MediaValidator extends BaseValidator
{
    protected array $scene = [
        'create' => ['name', 'url', 'file_size', 'ext','storage', 'category'],
        'update' => ['name', 'url', 'file_size', 'ext','storage', 'category'],
    ];

    public function rules(): array
    {
        return [
            'name' => ['required'],
            'url' => ['required'],
            'file_size' => ['required'],
            'ext' => ['required'],
            'storage' => ['required'],
            'category' => ['required'],
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => '名称',
            'url' => '链接',
            'file_size' => '文件大小',
            'ext' => '扩展名',
            'storage' => '存储位置',
            'category' => '分类',
        ];
    }
}
