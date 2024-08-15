<?php
namespace App\Model\Concerns;

use Illuminate\Database\Eloquent\Casts\Attribute;

trait HasStatus
{
    public const STATUS_ACTIVE = 1;

    public const STATUS_INACTIVE = 2;

    public static $statusTexts = [
        self::STATUS_ACTIVE => '正常',
        self::STATUS_INACTIVE => '停用',
    ];

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
}
