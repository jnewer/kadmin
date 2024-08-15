<?php

namespace app\controller;

use support\Request;
use support\Response;
use app\actions\ViewAction;
use app\actions\IndexAction;
use app\service\LoginLogService;
use app\controller\BaseController;

class LoginLogController extends BaseController
{
    use IndexAction;
    use ViewAction;
    
    protected LoginLogService $service;

    public function __construct(LoginLogService $service)
    {
        $this->service = $service;
    }
}
