<?php
namespace app\actions;

use support\Response;

/**
 * @property-read BaseService $service
 */
trait DeleteAction
{
    public function delete($id):Response
    {
        return success('删除成功', $this->service->delete((int)$id));
    }
}
