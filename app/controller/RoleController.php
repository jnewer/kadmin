<?php

namespace app\controller;

use support\Request;
use support\Response;
use app\controller\BaseController;
use app\service\RoleService;

class RoleController extends BaseController
{
    protected RoleService $service;

    public function __construct(RoleService $service)
    {
        $this->service = $service;
    }

    public function tree(Request $request): Response
    {
        $data = $this->service->tree();

        return success('success', $data);
    }
}
