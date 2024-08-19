<?php

namespace app\middleware;

use app\service\OperationLogService;
use support\Log;
use Tinywan\Jwt\JwtToken;
use Webman\MiddlewareInterface;
use Webman\Http\Response;
use Webman\Http\Request;

class OperationLogMiddleware implements MiddlewareInterface
{
    public function process(Request $request, callable $handler): Response
    {
        $method = $request->method();
        if (!in_array($request->action, ['login', 'logout']) && !in_array($method, ['GET', 'HEAD', 'OPTIONS'])) {
            try {
                $admin = JwtToken::getUser();
                OperationLogService::instance()->create([
                    'admin_id' => $admin->id,
                    'admin_username' => $admin->username,
                    'path' => $request->path(),
                    'method' => $method,
                    'ip' => $request->getRemoteIp(),
                    'user_agent' => $request->header('User-Agent') ?? 'unknown',
                    'input' => json_encode($request->all(), JSON_UNESCAPED_UNICODE),
                    'created_at' => date('Y-m-d H:i:s'),
                ]);
            } catch (\Exception $e) {
                Log::error('OperationLogMiddleware Error: '. $e->getMessage());
            }
        }

        return $handler($request);
    }
}
