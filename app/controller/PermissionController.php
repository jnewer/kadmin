<?php

namespace app\controller;

use support\Request;
use support\Response;
use app\controller\BaseController;
use app\service\PermissionService;

class PermissionController extends BaseController
{
    protected PermissionService $service;

    public function __construct(PermissionService $service)
    {
        $this->service = $service;
    }

    public function tree(Request $request): Response
    {
        $data = $this->service->tree();

        return success('获取成功', $data);
    }
}
