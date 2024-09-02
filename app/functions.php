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

if (!function_exists('is_options')) {
    function is_options(): bool
    {
        return request()->isOptions();
    }
}

if (!function_exists('parse_browser')) {
    function parse_browser($agent): string
    {
        if (stripos($agent, 'MSIE') !== false) {
            return 'MSIE';
        }

        if (stripos($agent, 'Edg') !== false) {
            return 'Edge';
        }

        if (stripos($agent, 'Chrome') !== false) {
            return 'Chrome';
        }

        if (stripos($agent, 'Firefox') !== false) {
            return 'Firefox';
        }

        if (stripos($agent, 'Safari') !== false) {
            return 'Safari';
        }

        if (stripos($agent, 'Opera') !== false) {
            return 'Opera';
        }

        return 'unknown';
    }

}

if (!function_exists('get_os')) {
    function get_os($agent): string
    {
        if (stripos($agent, 'win') !== false && preg_match('/nt 6.1/i', $agent)) {
            return 'Windows 7';
        }

        if (stripos($agent, 'win') !== false && preg_match('/nt 6.2/i', $agent)) {
            return 'Windows 8';
        }

        if (stripos($agent, 'win') !== false && preg_match('/nt 10.0/i', $agent)) {
            return 'Windows 10';
        }

        if (stripos($agent, 'win') !== false && preg_match('/nt 11.0/i', $agent)) {
            return 'Windows 11';
        }

        if (stripos($agent, 'win') !== false && preg_match('/nt 5.1/i', $agent)) {
            return 'Windows XP';
        }

        if (stripos($agent, 'linux') !== false) {
            return 'Linux';
        }

        if (stripos($agent, 'mac') !== false) {
            return 'Mac';
        }

        return 'unknown';
    }
}

if (!function_exists('get_ip_location')) {
    function get_ip_location($ip): string
    {
        $ip2region = new \Ip2Region();
        return$ip2region->simple($ip);
    }

}
