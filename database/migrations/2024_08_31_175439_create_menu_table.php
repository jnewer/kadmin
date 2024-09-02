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
        $this->schema()->create('menu', function (Blueprint $table) {
            $table->id();
            $table->string('path', 255)->nullable(false)->default('')->comment('路径');
            $table->string('component', 255)->nullable(false)->default('')->comment('组件');
            $table->string('redirect', 255)->nullable(false)->default('')->comment('重定向地址');
            $table->string('name', 50)->nullable(false)->default('')->comment('组件名称');
            $table->tinyInteger('status')->nullable(false)->default(0)->comment('状态(0:禁用,1:启用)');
            $table->tinyInteger('type')->unsigned()->nullable(false)->default(0)->comment('类型(0:目录,1:菜单,2:按钮)');
            $table->unsignedBigInteger('pid')->nullable(false)->default(0)->comment('父级ID');
            $table->string('title', 50)->nullable(false)->default('')->comment('名称');
            $table->string('permission', 50)->nullable(false)->default('')->comment('权限标识');
            $table->boolean('always_show')->nullable(false)->default(false)->comment('显示根路由');
            $table->string('icon', 50)->nullable(false)->default('')->comment('图标');
            $table->string('active_menu', 255)->nullable(false)->default('')->comment('高亮菜单');
            $table->dateTime('created_at')->nullable()->comment('创建时间');
            $table->dateTime('updated_at')->nullable()->comment('更新时间');
            $table->index('pid', 'idx_pid');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $this->schema()->dropIfExists('menu');
    }
};
