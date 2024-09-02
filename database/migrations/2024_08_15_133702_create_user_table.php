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
        $this->schema()->create('user', function (Blueprint $table) {
            $table->id();
            $table->string('username', 32)->nullable(false)->default('')->unique('uk_username')->comment('用户名');
            $table->string('nickname', 40)->nullable(false)->default('')->comment('昵称');
            $table->string('password', 64)->nullable(false)->default('')->comment('密码');
            $table->string('avatar', 255)->nullable(false)->default('')->comment('头像');
            $table->string('email', 50)->nullable()->default(null)->unique('uk_email')->comment('邮箱');
            $table->string('phone', 16)->nullable()->default(null)->unique('uk_phone')->comment('手机号');
            $table->unsignedTinyInteger('status')->nullable(false)->default(1)->comment('状态：0-禁用，1-启用');
            $table->dateTime('created_at')->nullable()->comment('创建时间');
            $table->dateTime('updated_at')->nullable()->comment('更新时间');
            $table->dateTime('login_at')->nullable()->comment('登录时间');
            $table->comment('用户表');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $this->schema()->dropIfExists('user');
    }
};
