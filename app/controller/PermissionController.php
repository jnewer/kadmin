<?php

namespace app\controller;

use support\Request;
use support\Response;
use app\actions\ViewAction;
use app\actions\IndexAction;
use app\actions\CreateAction;
use app\actions\DeleteAction;
use app\actions\UpdateAction;
use app\controller\BaseController;
use app\service\PermissionService;

class PermissionController extends BaseController
{
    use IndexAction;
    use CreateAction;
    use ViewAction;
    use UpdateAction;
    use DeleteAction;
    
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
