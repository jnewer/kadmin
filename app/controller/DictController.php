<?php

namespace app\controller;

use support\Request;
use support\Response;
use app\service\DictService;
use app\actions\HasCrudActions;
use app\actions\StatusAction;
use app\controller\BaseController;

class DictController extends BaseController
{
    use HasCrudActions;
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

    public function options($value, Request $request): Response
    {

        $options = $this->service->options($value);

        return success('获取成功', $options);
    }
}
