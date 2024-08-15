<?php

namespace app\controller;

use support\Request;
use support\Response;
use app\actions\ViewAction;
use app\actions\IndexAction;
use app\actions\CreateAction;
use app\actions\DeleteAction;
use app\actions\UpdateAction;
use app\service\ConfigService;

class ConfigController
{
    use IndexAction;
    use CreateAction;
    use ViewAction;
    use UpdateAction;
    use DeleteAction;
    
    protected ConfigService $service;

    public function __construct(ConfigService $service)
    {
        $this->service = $service;
    }
}
