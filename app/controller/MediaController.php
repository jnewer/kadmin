<?php

namespace app\controller;

use support\Request;
use support\Response;
use app\controller\BaseController;
use app\service\MediaService;

class MediaController extends BaseController
{
    protected MediaService $service;

    public function __construct(MediaService $service)
    {
        $this->service = $service;
    }
}
