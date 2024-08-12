<?php

namespace app\controller;

use support\Request;
use support\Response;
use DI\Attribute\Inject;
use app\controller\BaseController;
use app\service\PermissionService;

class PermissionController extends BaseController
{
    #[Inject]
    protected PermissionService $service;

    public function tree(Request $request): Response
    {
        $data = $this->service->tree();

        return success('success', $data);
    }
}
