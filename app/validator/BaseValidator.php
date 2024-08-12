<?php

namespace app\validator;

use Illuminate\Validation\ValidationException;

class BaseValidator
{
    protected array $scene = [];

    public function rules(): array
    {
        return [];
    }

    public function messages(): array
    {
        return [];
    }

    public function attributes(): array
    {
        return [];
    }

    public static function instance()
    {
        return new static();
    }

    public function getSceneRules(string $scene = ''): array
    {
        if (empty($scene)) {
            [];
        }
        $sceneFields = $this->scene[$scene] ?? [];

        if (empty($sceneFields)) {
            return [];
        }

        $rules = $this->rules();
        $sceneRules = [];
        foreach ($sceneFields as $field) {
            if (isset($rules[$field])) {
                $sceneRules[$field] = $rules[$field];
            }
        }

        return $sceneRules;
    }

    public function getSceneMessages(string $scene = ''): array
    {
        if (empty($scene)) {
            [];
        }

        return $this->messages()[$scene] ?? [];
    }

    public function validate(array $data, string $scene = '')
    {
        return validator($data, $this->getSceneRules($scene), $this->getSceneMessages($scene), $this->attributes())->validate();
    }

    public function validated(array $data, string $scene = '')
    {
        return validator($data, $this->getSceneRules($scene), $this->getSceneMessages($scene), $this->attributes())->validated();
    }
}
