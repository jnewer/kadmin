<?php

namespace app\controller;

use support\Request;
use support\Response;
use app\service\UserService;
use Tinywan\Jwt\JwtToken;

class AccountController extends BaseController
{
    protected UserService $service;

    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    public function profile(Request $request): Response
    {
        $userId = JwtToken::getCurrentId();
        $data = $this->service->profile((int)$userId);

        return success('获取成功', $data);
    }

    public function update(Request $request): Response
    {
        $userId = JwtToken::getCurrentId();
        $this->service->update((int)$userId, $request->all());

        return success('操作成功');
    }

    public function changePassword(Request $request): Response
    {
        $userId = JwtToken::getCurrentId();
        $this->service->changePassword((int)$userId, $request->all());

        return success('操作成功');
    }
}
