<?php

/**
 * This file is part of webman.
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the MIT-LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @author    walkor<walkor@workerman.net>
 * @copyright walkor<walkor@workerman.net>
 * @link      http://www.workerman.net/
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */

namespace support;

/**
 * Class Request
 * @package support
 */
class Request extends \Webman\Http\Request
{
    public function isOPtions()
    {
        return $this->method() === 'OPTIONS';
    }

    public function isGet()
    {
        return $this->method() === 'GET';
    }

    public function isPost()
    {
        return $this->method() === 'POST';
    }

    public function isPut()
    {
        return $this->method() === 'PUT';
    }

    public function isDelete()
    {
        return $this->method() === 'DELETE';
    }

    public function isHead()
    {
        return $this->method() === 'HEAD';
    }

    public function isPatch()
    {
        return $this->method() === 'PATCH';
    }
}
