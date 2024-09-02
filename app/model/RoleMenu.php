<?php

namespace app\model;

use app\model\BaseModel;

/**
 * role_menu 角色菜单表
 * @property integer $id (主键)
 * @property integer $role_id 角色ID
 * @property integer $menu_id 菜单ID
 */
class RoleMenu extends BaseModel
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
    protected $table = 'role_menu';

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
