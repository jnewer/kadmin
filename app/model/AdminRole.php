<?php

namespace app\model;

use app\model\BaseModel;

/**
 * admin_role 管理员角色表
 * @property integer $id ID
 * @property integer $role_id 角色id
 * @property integer $admin_id 管理员id
 */
class AdminRole extends BaseModel
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
    protected $table = 'admin_role';

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

    protected $fillable = [];

    protected $hidden = [];

}