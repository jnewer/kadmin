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

    /**
     * @param Request $request
     * @return Response
     */
    public function profile(Request $request): Response
    {
        $adminId = JwtToken::getCurrentId();
        $data = $this->service->profile((int)$adminId);

        return success('获取成功', $data);
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function update(Request $request): Response
    {
        $adminId = JwtToken::getCurrentId();
        $this->service->update((int)$adminId, $request->all());

        return success('更新成功');
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function changePassword(Request $request): Response
    {
        $adminId = JwtToken::getCurrentId();
        $this->service->changePassword((int)$adminId, $request->all());

        return success('修改成功');
    }
}
