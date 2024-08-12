<?php

namespace app\controller;

use support\Request;
use support\Response;
use DI\Attribute\Inject;
use app\controller\BaseController;
use app\service\RoleService;

class RoleController extends BaseController
{
    #[Inject]
    protected RoleService $service;

    public function tree(Request $request): Response
    {
        $data = $this->service->tree();

        return success('success', $data);
    }
}
