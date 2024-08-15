<?php

namespace app\actions;

use support\Request;
use support\Response;

/**
 * @property-read BaseService $service
 */
trait UpdateAction
{
    public function update($id, Request $request):Response
    {
        return success('更新成功', $this->service->update((int)$id, $request->all()));
    }
}
