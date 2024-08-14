<?php

namespace app\controller;

use support\Request;
use support\Response;
use app\controller\BaseController;
use app\service\DictService;

class DictController extends BaseController
{
    protected DictService $service;

    public function __construct(DictService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $params = $request->all();
        $params['pid'] = 0;
        return success('获取成功', $this->service->list($params));
    }

    public function items($id, Request $request)
    {
        $params = $request->all();
        $params['pid'] = $id;
        return success('获取成功', $this->service->list($params));
    }
}
