<?php

namespace app\controller;

use app\actions\CreateAction;
use app\actions\DeleteAction;
use support\Request;
use support\Response;
use app\actions\IndexAction;
use app\actions\StatusAction;
use app\actions\UpdateAction;
use app\actions\ViewAction;
use app\service\UserService;

class UserController
{
    use IndexAction;
    use CreateAction;
    use ViewAction;
    use UpdateAction;
    use DeleteAction;
    use StatusAction;

    protected UserService $service;

    public function __construct(UserService $service)
    {
        $this->service = $service;
    }
}
