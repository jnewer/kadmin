<?php

namespace app\controller;

use support\Request;
use support\Response;
use app\controller\BaseController;
use app\service\AuthService;

class AuthController extends BaseController
{
    protected AuthService $service;

    public function __construct(AuthService $service)
    {
        $this->service = $service;
    }

    public function login(Request $request): Response
    {
        $result = $this->service->login($request->all());
        return success('登录成功', $result);
    }

    public function logout(Request $request): Response
    {
        $this->service->logout();
        return success();
    }
}
