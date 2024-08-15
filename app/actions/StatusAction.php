<?php

namespace app\actions;

use support\Request;
use support\Response;

/**
 * @property-read BaseService $service
 */
trait StatusAction
{
    public function status(int $id, Request $request): Response
    {
        $this->service->status($id, $request->input('status'));
        return success('操作成功');
    }
}
