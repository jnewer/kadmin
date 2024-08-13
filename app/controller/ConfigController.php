<?php

namespace app\controller;

use support\Request;
use support\Response;
use app\controller\BaseController;
use app\service\ConfigService;

class ConfigController extends BaseController
{
    protected ConfigService $service;

    public function __construct(ConfigService $service)
    {
        $this->service = $service;
    }
}
