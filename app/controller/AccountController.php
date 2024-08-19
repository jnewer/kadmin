<?php

namespace app\controller;

use support\Request;
use support\Response;
use app\service\AdminService;
use Tinywan\Jwt\JwtToken;

class AccountController extends BaseController
{
    protected AdminService $service;

    public function __construct(AdminService $service)
    {
        $this->service = $service;
    }

    public function profile(Request $request): Response
    {
        $adminId = JwtToken::getCurrentId();
        $data = $this->service->profile((int)$adminId);

        return success('获取成功', $data);
    }

    public function update(Request $request): Response
    {
        $adminId = JwtToken::getCurrentId();
        $this->service->update((int)$adminId, $request->all());

        return success('操作成功');
    }

    public function changePassword(Request $request): Response
    {
        $adminId = JwtToken::getCurrentId();
        $this->service->changePassword((int)$adminId, $request->all());

        return success('操作成功');
    }
}
