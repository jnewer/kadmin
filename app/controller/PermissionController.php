<?php

namespace app\controller;

use support\Request;
use support\Response;
use app\actions\HasCrudActions;
use app\controller\BaseController;
use app\service\PermissionService;

class PermissionController extends BaseController
{
    use HasCrudActions;

    protected PermissionService $service;

    public function __construct(PermissionService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request): Response
    {
        $data = $this->service->tree();

        return success('获取成功', $data);
    }

    public function options(Request $request): Response
    {
        $data = $this->service->tree(['type' => [0,1]]);

        return success('获取成功', $data);
    }
}
