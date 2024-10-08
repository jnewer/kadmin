<?php

namespace app\validator;

class BaseValidator
{
    protected array $scene = [];

    protected $modelId = null;

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

    public function validated(array $data, string $scene = '')
    {
        $sceneRules = $this->getSceneRules($scene);

        if (empty($sceneRules)) {
            return $data;
        }

        return validator($data, $sceneRules, $this->getSceneMessages($scene), $this->attributes())->validated();
    }

    public function setModelId(int $id)
    {
        $this->modelId = $id;

        return $this;
    }
}
