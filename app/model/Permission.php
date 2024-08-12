<?php

namespace app\model;

use app\model\BaseModel;

/**
 * permission 权限规则
 * @property integer $id 主键(主键)
 * @property string $title 标题
 * @property string $icon 图标
 * @property string $key 标识
 * @property integer $pid 上级菜单
 * @property string $created_at 创建时间
 * @property string $updated_at 更新时间
 * @property string $href url
 * @property integer $type 类型
 * @property integer $weight 排序
 *
 * @property-read Permission $parent 父级菜单
 * @property-read Permission[] $children 子菜单
 */
class Permission extends BaseModel
{
    const TYPE_DIRECTORY = 0;
    const TYPE_MENU = 1;
    const TYPE_ACTION = 2;
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
    protected $table = 'permission';

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

    protected $fillable = ['title', 'icon', 'key', 'pid', 'created_at', 'updated_at', 'href', 'type', 'weight'];

    protected $hidden = [];

    public function children()
    {
        return $this->hasMany(Permission::class, 'pid', 'id');
    }

    public function parent()
    {
        return $this->belongsTo(Permission::class, 'pid', 'id');
    }
}
