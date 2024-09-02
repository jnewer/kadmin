<?php

namespace app\model;

use app\model\BaseModel;

/**
 * media 附件
 * @property integer $id ID
 * @property string $name 名称
 * @property string $url 文件
 * @property integer $user_id 用户
 * @property integer $file_size 文件大小
 * @property string $mime_type mime类型
 * @property integer $image_width 图片宽度
 * @property integer $image_height 图片高度
 * @property string $ext 扩展名
 * @property string $storage 存储位置
 * @property string $category 类别
 * @property string $created_at 上传时间
 * @property string $updated_at 创建时间
 *
 * @property-read User $user 用户
 */
class Media extends BaseModel
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
    protected $table = 'media';

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

    protected $fillable = ['name', 'url', 'user_id', 'file_size', 'mime_type', 'image_width', 'image_height', 'ext', 'storage', 'category', 'created_at', 'updated_at'];

    protected $hidden = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
