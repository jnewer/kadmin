<?php

namespace app\model;

use app\model\BaseModel;

/**
 * operation_log
 * @property integer $id ID(主键)
 * @property integer $admin_id 用户ID
 * @property string $admin_username 用户名
 * @property string $path 请求路径
 * @property string $method 请求方法
 * @property string $ip 请求IP
 * @property string $user_agent 请求UA
 * @property string $input 请求参数
 * @property string $created_at 创建时间
 *
 * @property-read Admin $admin 管理员
 */
class OperationLog extends BaseModel
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
    protected $table = 'operation_log';

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

    protected $fillable = ['admin_id', 'admin_username', 'path', 'method', 'ip', 'input', 'created_at'];

    protected $hidden = [];

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id', 'id');
    }
}
