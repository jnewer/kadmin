<?php

namespace app\model;

use app\model\BaseModel;

/**
 * dict_type 字典类型
 * @property integer $id ID(主键)
 * @property string $name 字典名称
 * @property string $code 字典标识
 * @property integer $status 状态 (1正常 0禁用)
 * @property string $created_at 创建时间
 * @property string $updated_at 更新时间
 * @property string $remark 备注
 */
class DictType extends BaseModel
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
    protected $table = 'dict_type';

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
