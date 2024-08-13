<?php

namespace app\model;

use app\model\BaseModel;

/**
 * dict_data 字典数据表
 * @property integer $id ID(主键)
 * @property integer $type_id 字典类型ID
 * @property string $label 字典标签
 * @property string $value 字典值
 * @property string $code 字典标识
 * @property integer $sort 排序
 * @property integer $status 状态 (1正常 0禁用)
 * @property string $created_at 创建时间
 * @property string $updated_at 更新时间
 * @property string $remark 备注
 */
class DictData extends BaseModel
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
    protected $table = 'dict_data';

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
