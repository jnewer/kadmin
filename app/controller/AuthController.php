<?php

namespace app\controller;

use support\Db;
use support\Request;
use support\Response;
use app\model\LoginLog;
use app\service\AuthService;
use app\service\LoginLogService;
use app\controller\BaseController;

class AuthController extends BaseController
{
    protected AuthService $service;

    public function __construct(AuthService $service)
    {
        $this->service = $service;
    }

    public function login(Request $request): Response
    {
        $params = $request->all();

        Db::beginTransaction();
        try {
            $result = $this->service->login($params);
            $userAgent = $request->header('User-Agent') ?? 'unknown';
            $ip = $request->getRemoteIp();

            (new LoginLogService())->create([
                'username' => $params['username'],
                'ip' => $ip,
                'ip_location' => get_ip_location($ip),
                'os' => get_os($userAgent),
                'browser' => parse_browser($userAgent),
                'status' => LoginLog::STATUS_SUCCESS,
                'message' => '登录成功',
                'login_time' => date('Y-m-d H:i:s')
            ]);

            Db::commit();

            return success('登录成功', $result);
        } catch (\Exception $e) {
            Db::rollBack();

            return fail('登录失败：' . $e->getMessage());
        }
    }

    public function logout(Request $request): Response
    {
        $this->service->logout();
        return success();
    }
}
