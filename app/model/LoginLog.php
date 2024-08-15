<?php

namespace app\model;

use Illuminate\Database\Eloquent\Casts\Attribute;
use app\model\BaseModel;

/**
 * login_log 登录日志
 * @property integer $id ID(主键)
 * @property string $username 用户名
 * @property string $ip 登录IP地址
 * @property string $ip_location IP所属地
 * @property string $os 操作系统
 * @property string $browser 浏览器
 * @property integer $status 登录状态 (1成功 2失败)
 * @property string $message 提示消息
 * @property string $login_time 登录时间
 */
class LoginLog extends BaseModel
{
    /**
     * The connection name for the model.
     *
     * @var string|null
     */
    protected $connection = 'mysql';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'login_log';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    protected $guarded = [];

    protected $fillable = ['username', 'ip', 'ip_location', 'os', 'browser','status','message', 'login_time'];

    protected $hidden = [];

    public const STATUS_SUCCESS = 1;

    public const STATUS_FAILED = 0;

    public static $statusTexts = [
        self::STATUS_FAILED => '失败',
        self::STATUS_SUCCESS => '成功',
    ];

    public function statusText(): Attribute
    {
        return Attribute::make(
            get: fn () => self::$statusTexts[$this->status] ?? ''
        );
    }
}
