<?php
namespace app\model\concerns;

use Illuminate\Database\Eloquent\Casts\Attribute;

trait HasStatus
{
    public const STATUS_ACTIVE = 1;
    public const STATUS_INACTIVE = 2;

    protected static $statusTexts = [
        self::STATUS_ACTIVE => '正常',
        self::STATUS_INACTIVE => '停用',
    ];

    protected function statusText(): Attribute
    {
        return Attribute::make(
            get: fn () => self::$statusTexts[$this->status] ?? '未知'
        );
    }

    protected function isActive(): bool
    {
        return $this->status === self::STATUS_ACTIVE;
    }
}
