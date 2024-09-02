<?php

namespace app\actions;

use support\Request;
use support\Response;

/**
 * @property-read BaseService $service
 */
trait UpdateAction
{
    public function update($id, Request $request): Response
    {
        $this->service->update((int)$id, $request->all());

        return success('操作成功');
    }
}
