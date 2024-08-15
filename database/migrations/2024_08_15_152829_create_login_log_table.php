<?php

use Illuminate\Database\Schema\Blueprint;
use Eloquent\Migrations\Migrations\Migration;
use support\Db;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $this->schema()->create('login_log', function (Blueprint $table) {
            $table->id()->comment('ID');
            $table->string('username', 20)->nullable(false)->default('')->comment('用户名')->unique('uk_username');
            $table->string('ip', 45)->nullable()->comment('登录IP地址');
            $table->string('ip_location', 255)->nullable(false)->default('')->comment('IP所属地');
            $table->string('os', 50)->nullable(false)->default('')->comment('操作系统');
            $table->string('browser', 50)->nullable(false)->default('')->comment('浏览器');
            $table->unsignedInteger('status')->nullable(false)->default(1)->comment('登录状态 (1成功 2失败)');
            $table->string('message', 50)->nullable(false)->default('')->comment('提示消息');
            $table->dateTime('login_time')->nullable(false)->default(Db::raw('CURRENT_TIMESTAMP'))->comment('登录时间');

            $table->comment('登录日志');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $this->schema()->dropIfExists('login_log');
    }
};
