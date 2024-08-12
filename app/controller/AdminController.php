<?php

namespace app\controller;

use support\Request;
use support\Response;
use DI\Attribute\Inject;
use app\controller\BaseController;
use app\service\AdminService;

class AdminController extends BaseController
{
    #[Inject]
    protected AdminService $service;
}
