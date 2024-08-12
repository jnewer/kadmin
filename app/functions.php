<?php

use support\Model;
use support\Response;

/**
 * Here is your custom functions.
 */



if (!function_exists('success')) {
    /**
     * @param  string $message
     * @param  array|Model $data
     * @return Response
     */
    function success($message = '成功', $data = []): Response
    {
        if ($data instanceof Model) {
            $data = $data->toArray();
        }

        return json([
            'code' => 0,
            'message' => $message,
            'success' => true,
            'data'    => $data,
        ]);
    }
}

if (!function_exists('fail')) {
    /**
     * @param  string $message
     * @param  int  $code
     * @return Response
     */
    function fail($message = '失败', int $code = 1): Response
    {
        return json([
            'code' => $code,
            'message' => $message,
            'success' => false,
            'data'    => [],
        ]);
    }
}

if (!function_exists('is_post')) {
    function is_post(): bool
    {
        return request()->isPost();
    }
}

if (!function_exists('is_get')) {
    function is_get(): bool
    {
        return request()->isGet();
    }
}
