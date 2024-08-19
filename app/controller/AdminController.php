<?php

namespace app\controller;

use support\Request;
use support\Response;
use Tinywan\Jwt\JwtToken;
use app\actions\HasCrudActions;
use app\actions\StatusAction;
use app\service\AdminService;
use support\Db;
use support\exception\BusinessException;

class AdminController extends BaseController
{
    use HasCrudActions;
    use StatusAction;
    
    protected AdminService $service;

    public function __construct(AdminService $service)
    {
        $this->service = $service;
    }

    public function delete($id): Response
    {
        Db::beginTransaction();
        try {
            if ($id == JwtToken::getCurrentId()) {
                throw new BusinessException('不能删除自己');
            }

            $this->service->delete((int)$id);

            Db::commit();

            return success('删除成功');
        } catch (\Exception $e) {
            Db::rollBack();

            return fail('删除失败：' . $e->getMessage());
        }
    }
}
