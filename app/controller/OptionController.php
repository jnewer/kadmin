<?php

namespace app\controller;

use support\Request;
use support\Response;
use app\controller\BaseController;
use app\service\OptionService;

class OptionController extends BaseController
{
    protected OptionService $service;

    public function __construct(OptionService $service)
    {
        $this->service = $service;
    }
}
