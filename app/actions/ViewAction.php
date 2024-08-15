<?php

namespace app\actions;

use support\Response;

/**
 * @property-read BaseService $service
 */
trait ViewAction
{
    public function view($id):Response
    {
        return success('获取成功', $this->service->detail((int)$id));
    }
}
