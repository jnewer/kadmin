<?php

namespace app\controller;

use support\Request;
use Webman\Http\Response;
use app\service\BaseService;

/**
 * @property-read BaseService $service
 */
class BaseController
{
    public function index(Request $request)
    {
        return success('获取成功', $this->service->list($request->all()));
    }

    public function create(Request $request)
    {
        return success('创建成功', $this->service->create($request->all()));
    }

    public function view($id)
    {
        return success('获取成功', $this->service->detail((int)$id));
    }

    public function update($id, Request $request)
    {
        return success('更新成功', $this->service->update((int)$id, $request->all()));
    }

    public function delete($id)
    {
        return success('删除成功', $this->service->delete((int)$id));
    }
    public function status(int $id, Request $request): Response
    {
        $this->service->status($id, $request->input('status'));
        return success('操作成功');
    }
}
