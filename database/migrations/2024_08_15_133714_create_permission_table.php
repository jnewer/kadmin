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
        $this->schema()->create('permission', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255)->nullable(false)->default('')->comment('名称');
            $table->string('icon', 255)->nullable(false)->default('')->comment('图标');
            $table->string('key', 255)->nullable(false)->default('')->comment('标识');
            $table->unsignedBigInteger('pid')->nullable(false)->default(0)->comment('父级ID');
            $table->string('href', 255)->nullable(false)->default('')->comment('链接');
            $table->unsignedTinyInteger('type')->default(1)->comment('类型：0-目录；1-菜单；2-按钮');
            $table->unsignedInteger('sort')->nullable(false)->default(0)->comment('排序');
            $table->dateTime('created_at')->nullable()->comment('创建时间');
            $table->dateTime('updated_at')->nullable()->comment('更新时间');
            $table->comment('权限表');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $this->schema()->dropIfExists('permission');
    }
};
