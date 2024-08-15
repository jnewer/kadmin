<?php

namespace app\model;

use support\Model;

class BaseModel extends Model
{
    /**
     * 格式化日期
     *
     * @param \DateTimeInterface $date
     * @return string
     */
    protected function serializeDate(\DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
