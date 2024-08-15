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
        $this->schema()->create('config', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100)->nullable(false)->default('')->unique('uk_name')->comment('名称');
            $table->text('value')->nullable()->default(null)->comment('值');
            $table->dateTime('created_at')->nullable()->comment('创建时间');
            $table->dateTime('updated_at')->nullable()->comment('更新时间');
            $table->comment('系统配置表');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $this->schema()->dropIfExists('config');
    }
};
