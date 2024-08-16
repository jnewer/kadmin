<?php

namespace app\model;

use app\model\BaseModel;

/**
 *
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
}
