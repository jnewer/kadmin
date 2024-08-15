<?php

namespace app\model;

use app\model\BaseModel;

/**
 * dict 字典
 * @property integer $id ID
 * @property integer $pid 上级ID
 * @property string $name 名称
 * @property string $value 值
 * @property integer $status 状态 (1正常 0禁用)
 * @property string $created_at 创建时间
 * @property string $updated_at 更新时间
 * @property string $remark 备注
 */
class Dict extends BaseModel
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
    protected $table = 'dict';

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

    protected $fillable = ['pid', 'name', 'value', 'status', 'remark', 'created_at', 'updated_at'];

    protected $hidden = [];
}
