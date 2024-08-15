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
        $this->schema()->create('dict', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('pid')->nullable(false)->default(0)->comment('父级ID');
            $table->string('name', 50)->nullable(false)->default('')->unique('uk_name')->comment('名称');
            $table->string('value', 100)->nullable(false)->default('')->comment('值');
            $table->unsignedTinyInteger('status')->nullable(false)->default(1)->comment('状态：0-禁用，1-启用');
            $table->string('remark', 255)->nullable(false)->default('')->comment('备注');
            $table->dateTime('created_at')->nullable()->comment('创建时间');
            $table->dateTime('updated_at')->nullable()->comment('更新时间');
            $table->comment('字典表');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $this->schema()->dropIfExists('dict');
    }
};
