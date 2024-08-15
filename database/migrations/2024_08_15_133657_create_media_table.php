<?php

use Illuminate\Database\Schema\Blueprint;
use Eloquent\Migrations\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $this->schema()->create('media', function (Blueprint $table) {
            $table->id();
            $table->string('name', 128)->nullable(false)->default('')->index('idx_name')->comment('文件名');
            $table->string('url', 255)->nullable(false)->default('')->comment('文件路径');
            $table->unsignedBigInteger('admin_id')->default(0)->index('idx_admin_id')->comment('上传者ID');
            $table->unsignedInteger('file_size')->nullable(false)->default(0)->comment('文件大小');
            $table->string('mime_type', 255)->nullable(false)->default('')->comment('文件类型');
            $table->unsignedInteger('image_width')->nullable()->default(null)->comment('图片宽度');
            $table->unsignedInteger('image_height')->nullable()->default(null)->comment('图片高度');
            $table->string('md5', 32)->nullable(false)->default('')->comment('文件MD5');
            $table->string('ext', 128)->nullable(false)->default('')->comment('文件扩展名')->index('idx_ext');
            $table->string('storage', 255)->nullable(false)->default('local')->comment('存储位置');
            $table->string('category', 128)->nullable(false)->default('')->comment('分类')->index('idx_category');
            $table->dateTime('created_at')->nullable()->comment('创建时间');
            $table->dateTime('updated_at')->nullable()->comment('更新时间');
            $table->comment('附件表');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $this->schema()->dropIfExists('media');
    }
};
