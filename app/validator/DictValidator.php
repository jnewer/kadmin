<?php

namespace app\validator;

use app\validator\BaseValidator;

class DictValidator extends BaseValidator
{
    protected array $scene = [];

    public function rules(): array
    {
        return [];
    }

    public function attributes(): array
    {
        return [];
    }
}
