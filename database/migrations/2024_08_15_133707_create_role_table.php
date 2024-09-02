<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Eloquent\Migrations\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $this->schema()->create('role', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50)->nullable(false)->default('')->unique('uk_name')->comment('名称');
            $table->string('display_name', 20)->nullable(false)->default('')->comment('显示名称');
            $table->dateTime('created_at')->nullable()->comment('创建时间');
            $table->dateTime('updated_at')->nullable()->comment('更新时间');
            $table->unsignedBigInteger('pid')->nullable(false)->default(0)->comment('父级ID');
            $table->comment('角色表');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $this->schema()->dropIfExists('role');
    }
};
