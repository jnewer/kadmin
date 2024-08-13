<?php

namespace app\controller;

use support\Request;
use support\Response;
use app\controller\BaseController;
use app\service\DictTypeService;

class DictTypeController extends BaseController
{
    protected DictTypeService $service;

    public function __construct(DictTypeService $service)
    {
        $this->service = $service;
    }
}
