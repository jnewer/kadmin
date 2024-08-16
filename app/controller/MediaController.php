<?php

namespace app\controller;

use support\Request;
use support\Response;
use app\actions\HasCrudActions;
use app\service\MediaService;
use app\controller\BaseController;

class MediaController extends BaseController
{
    use HasCrudActions;
    
    protected MediaService $service;

    public function __construct(MediaService $service)
    {
        $this->service = $service;
    }
}
