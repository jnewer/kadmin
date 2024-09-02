<?php

namespace app\controller;

use app\service\BaseService;

/**
 * @property-read BaseService $service
 */
class BaseController
{
    protected array $skipAuth = [];
}
