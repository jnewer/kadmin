<?php

namespace app\controller;

use support\Request;
use support\Response;
use app\service\OperationLogService;
use app\actions\IndexAction;
use app\actions\ViewAction;

class OperationLogController
{
    use IndexAction;
    use ViewAction;

    protected OperationLogService $service;

    public function __construct(OperationLogService $service)
    {
        $this->service = $service;
    }
}
