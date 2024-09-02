<?php

namespace app\controller;

use support\Request;
use support\Response;
use app\actions\HasCrudActions;
use app\service\MediaService;
use app\controller\BaseController;
use Tinywan\Jwt\JwtToken;

class MediaController extends BaseController
{
    use HasCrudActions;

    protected MediaService $service;

    public function __construct(MediaService $service)
    {
        $this->service = $service;
    }

    public function create(Request $request): Response
    {
        $params = $request->all();
        $params['file'] = current($request->file());
        $params['user_id'] = JwtToken::getCurrentId();
        $this->service->create($params);

        return success('操作成功');
    }
}
