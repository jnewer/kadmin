<?php

namespace app\controller;

use support\Request;
use support\Response;
use app\service\UserService;
use Tinywan\Jwt\JwtToken;

class AccountController
{
    protected UserService $service;

    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function profile(Request $request): Response
    {
        $userId = JwtToken::getCurrentId();
        $data = $this->service->profile((int)$userId);

        return success('获取成功', $data);
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function update(Request $request): Response
    {
        $userId = JwtToken::getCurrentId();
        $this->service->update((int)$userId, $request->all());

        return success('更新成功');
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function changePassword(Request $request): Response
    {
        $userId = JwtToken::getCurrentId();
        $this->service->changePassword((int)$userId, $request->all());

        return success('密码修改成功');
    }
}
