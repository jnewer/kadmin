<?php

namespace app\model;

use support\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class BaseModel extends Model
{
    public const STATUS_ACTIVE = 1;

    public const STATUS_INACTIVE = 2;

    public static $statusTexts = [
        self::STATUS_ACTIVE => '正常',
        self::STATUS_INACTIVE => '停用',
    ];

    public $statusText;

    public function statusText(): Attribute
    {
        return Attribute::make(
            get: fn () => self::$statusTexts[$this->status] ?? ''
        );
    }

    public function isActive(): bool
    {
        return $this->status === self::STATUS_ACTIVE;
    }

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
