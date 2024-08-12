<?php

namespace app\controller;

use support\Request;
use support\Response;
use DI\Attribute\Inject;
use app\controller\BaseController;
use app\service\AuthService;

class AuthController extends BaseController
{
    #[Inject]
    protected AuthService $service;

    /**
     * @param Request $request
     * @return Response
     */
    public function login(Request $request): Response
    {
        $result = $this->service->login($request->all());
        return success('success', $result);
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function logout(Request $request): Response
    {
        $this->service->logout();
        return success();
    }
}
