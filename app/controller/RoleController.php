<?php

namespace app\controller;

use support\Request;
use support\Response;
use app\actions\ViewAction;
use app\actions\IndexAction;
use app\service\RoleService;
use app\actions\CreateAction;
use app\actions\DeleteAction;
use app\actions\UpdateAction;
use app\controller\BaseController;
use support\Db;

class RoleController extends BaseController
{
    use IndexAction;
    use CreateAction;
    use ViewAction;
    use UpdateAction;
    use DeleteAction;

    protected RoleService $service;

    public function __construct(RoleService $service)
    {
        $this->service = $service;
    }

    public function tree(Request $request): Response
    {
        $data = $this->service->tree();

        return success('获取成功', $data);
    }

    public function assignAuth($id, Request $request): Response
    {
        Db::beginTransaction();
        try {
            $this->service->assignAuth((int)$id, $request->all());
            Db::commit();
            return success('授权成功');
        } catch (\Exception $e) {
            Db::rollBack();
            return fail('授权失败：' . $e->getMessage());
        }
    }
}
