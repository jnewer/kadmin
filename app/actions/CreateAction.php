<?php

namespace app\actions;

use support\Request;
use support\Response;

/**
 * @property-read BaseService $service
 */
trait CreateAction
{
    public function create(Request $request):Response
    {
        return success('创建成功', $this->service->create($request->all()));
    }
}
