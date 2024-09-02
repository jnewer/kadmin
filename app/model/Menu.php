<?php

namespace app\model;

use app\model\BaseModel;

/**
 * menu
 * @property integer $id (主键)
 * @property string $path 路径
 * @property string $component 组件
 * @property string $redirect 重定向地址
 * @property string $name 组件名称
 * @property integer $status 状态(0:禁用,1:启用)
 * @property integer $type 类型(0:目录,1:菜单,2:按钮)
 * @property integer $pid 父级ID
 * @property string $title 名称
 * @property string $permission 权限标识
 * @property integer $always_show 显示根路由
 * @property string $icon 图标
 * @property string $active_menu 高亮菜单
 * @property string $created_at 创建时间
 * @property string $updated_at 更新时间
 */
class Menu extends BaseModel
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
    protected $table = 'menu';

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
