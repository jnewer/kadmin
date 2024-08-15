<?php

namespace app\actions;

use support\Request;
use support\Response;

/**
 * @property-read BaseService $service
 */
trait IndexAction
{
    public function index(Request $request): Response
    {
        return success('获取成功', $this->service->list($request->all()));
    }
}
