<?php

namespace app\middleware;

use app\service\AuthService;
use Jnewer\ExceptionHandler\Exception\ForbiddenHttpException;
use Webman\Http\Request;
use Tinywan\Jwt\JwtToken;
use Webman\Http\Response;
use Webman\MiddlewareInterface;
use Jnewer\ExceptionHandler\Exception\UnauthorizedHttpException;

class AccessControl implements MiddlewareInterface
{
    public function process(Request $request, callable $handler): Response
    {
        $path = $request->path();
        $controller = $request->controller;
        $action = $request->action;
        if (!in_array($action, ['login', 'logout']) && !is_options()) {
            $request->uid = JwtToken::getCurrentId();
            if (0 === $request->uid) {
                throw new UnauthorizedHttpException();
            }

            if (!AuthService::canAccess($request->uid, $controller, $action, $path)) {
                throw new ForbiddenHttpException('没有权限访问，请联系管理员');
            }
        }

        return $handler($request);
    }
}
