<?php

namespace app\controller;

use support\Request;
use support\Response;
use DI\Attribute\Inject;
use app\controller\BaseController;
use app\service\OptionService;

class OptionController extends BaseController
{
    #[Inject]
    protected OptionService $service;
}