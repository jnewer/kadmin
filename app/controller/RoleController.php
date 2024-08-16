<?php

namespace app\controller;

use support\Request;
use support\Response;
use app\actions\ViewAction;
use app\service\RoleService;
use app\actions\DeleteAction;
use app\controller\BaseController;
use support\Db;

class RoleController extends BaseController
{
    use ViewAction;
    use DeleteAction;

    protected RoleService $service;

    public function __construct(RoleService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request): Response
    {
        $data = $this->service->tree();

        return success('获取成功', $data);
    }

    public function create(Request $request): Response
    {
        Db::beginTransaction();
        try {
            $this->service->create($request->all());

            Db::commit();

            return success('创建成功');
        } catch (\Exception $e) {
            Db::rollBack();

            return fail('创建失败：' . $e->getMessage());
        }
    }

    public function update($id, Request $request): Response
    {
        Db::beginTransaction();
        try {
            $this->service->update((int)$id, $request->all());

            Db::commit();

            return success('更新成功');
        } catch (\Exception $e) {
            Db::rollBack();

            return fail('更新失败：' . $e->getMessage());
        }
    }

    public function assignAuth($id, Request $request): Response
    {
        Db::beginTransaction();
        try {
            $this->service->assignAuth((int)$id, $request->input('permission_ids'));
            
            Db::commit();

            return success('授权成功');
        } catch (\Exception $e) {
            Db::rollBack();

            return fail('授权失败：' . $e->getMessage());
        }
    }

    public function options(Request $request): Response
    {
        $data = $this->service->tree();

        return success('获取成功', $data);
    }
}
