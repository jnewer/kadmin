<?php

namespace app\controller;

use support\Request;
use support\Response;
use app\controller\BaseController;
use app\service\DictDataService;

class DictDataController extends BaseController
{
    protected DictDataService $service;

    public function __construct(DictDataService $service)
    {
        $this->service = $service;
    }
}