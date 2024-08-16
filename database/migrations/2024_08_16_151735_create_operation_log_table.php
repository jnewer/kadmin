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
        $this->schema()->create('operation_log', function (Blueprint $table) {
            $table->id()->comment('ID');
            $table->unsignedBigInteger('admin_id')->nullable(false)->default(0)->comment('用户ID');
            $table->string('admin_username')->nullable(false)->default('')->comment('用户名');
            $table->string('path', 100)->nullable(false)->default('')->comment('请求路径');
            $table->string('method', 10)->nullable(false)->default('')->comment('请求方法');
            $table->string('ip', 45)->nullable(false)->default('')->comment('请求IP');
            $table->string('user_agent')->nullable(false)->default('')->comment('请求UA');
            $table->text('input')->nullable()->comment('请求参数');
            $table->dateTime('created_at')->nullable()->comment('创建时间');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $this->schema()->dropIfExists('operation_log');
    }
};
