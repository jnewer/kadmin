<?php

namespace app\controller;

use support\Request;
use support\Response;
use app\actions\ViewAction;
use app\actions\IndexAction;
use app\service\DictService;
use app\actions\CreateAction;
use app\actions\DeleteAction;
use app\actions\StatusAction;
use app\actions\UpdateAction;
use app\controller\BaseController;

class DictController extends BaseController
{
    use IndexAction;
    use CreateAction;
    use ViewAction;
    use UpdateAction;
    use DeleteAction;
    use StatusAction;
    
    protected DictService $service;

    public function __construct(DictService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request): Response
    {
        $params = $request->all();
        $params['pid'] = 0;
        return success('获取成功', $this->service->list($params));
    }

    public function items($id, Request $request): Response
    {
        $params = $request->all();
        $params['pid'] = $id;
        return success('获取成功', $this->service->list($params));
    }
}
