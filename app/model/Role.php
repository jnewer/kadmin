<?php

namespace app\model;

use app\model\BaseModel;

/**
 * role 用户角色
 * @property integer $id ID
 * @property string $name 名称
 * @property string $created_at 创建时间
 * @property string $updated_at 更新时间
 * @property integer $pid 父级ID
 *
 * @property-read User[] $users 用户
 * @property-read Permission[] $permissions 权限
 * @property-read Role[] $children 子角色
 * @property-read Role $parent 父级角色
 */
class Role extends BaseModel
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
    protected $table = 'role';

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
    public $timestamps = true;

    protected $guarded = [];

    protected $fillable = ['name', 'pid', 'created_at', 'updated_at'];

    protected $hidden = [];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_role', 'role_id', 'user_id');
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'role_permission', 'role_id', 'permission_id');
    }

    public function children()
    {
        return $this->hasMany(Role::class, 'pid', 'id');
    }

    public function parent()
    {
        return $this->belongsTo(Role::class, 'pid', 'id');
    }
}
