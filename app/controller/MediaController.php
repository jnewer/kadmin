<?php

namespace app\controller;

use support\Request;
use support\Response;
use app\actions\ViewAction;
use app\actions\IndexAction;
use app\actions\CreateAction;
use app\actions\DeleteAction;
use app\actions\UpdateAction;
use app\service\MediaService;
use app\controller\BaseController;

class MediaController
{
    use IndexAction;
    use CreateAction;
    use ViewAction;
    use UpdateAction;
    use DeleteAction;
    
    protected MediaService $service;

    public function __construct(MediaService $service)
    {
        $this->service = $service;
    }
}
