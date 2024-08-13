<?php

namespace app\controller;

use support\Request;
use support\Response;
use app\controller\BaseController;
use app\service\AdminService;

class AdminController extends BaseController
{
    protected AdminService $service;

    public function __construct(AdminService $service)
    {
        $this->service = $service;
    }
}
