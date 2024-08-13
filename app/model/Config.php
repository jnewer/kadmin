<?php

namespace app\model;

use app\model\BaseModel;

/**
 * config 
 * @property integer $id ID(主键)
 * @property string $name 名称
 * @property string $value 值
 * @property string $created_at 创建时间
 * @property string $updated_at 更新时间
 */
class Config extends BaseModel
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
    protected $table = 'config';

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