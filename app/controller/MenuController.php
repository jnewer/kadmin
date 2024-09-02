<?php

namespace app\controller;

use support\Request;
use support\Response;
use app\controller\BaseController;
use app\service\MenuService;

use app\actions\HasCrudActions;

class MenuController extends BaseController
{
    use HasCrudActions;

    protected MenuService $service;

    public function __construct(MenuService $service)
    {
        $this->service = $service;
    }
}