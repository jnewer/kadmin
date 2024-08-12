<?php

namespace app\controller;

use support\Request;
use support\Response;
use DI\Attribute\Inject;
use app\controller\BaseController;
use app\service\MediaService;

class MediaController extends BaseController
{
    #[Inject]
    protected MediaService $service;
}