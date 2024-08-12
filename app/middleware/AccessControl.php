<?php

namespace app\middleware;

use Webman\Http\Request;
use Tinywan\Jwt\JwtToken;
use Webman\Http\Response;
use Webman\MiddlewareInterface;
use Jnewer\ExceptionHandler\Exception\UnauthorizedHttpException;

class AccessControl implements MiddlewareInterface
{
    public function process(Request $request, callable $next): Response
    {
        $url = $request->path();
        $controller = $request->controller;
        $action = $request->action;
        $method = $request->method();
        if (!in_array($action, ['login', 'logout'])) {
            $request->uid = JwtToken::getCurrentId();
            if (0 === $request->uid) {
                throw new UnauthorizedHttpException();
            }
        }

        return $next($request);
    }
}
