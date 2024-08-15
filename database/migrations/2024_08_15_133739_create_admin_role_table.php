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
        $this->schema()->create('admin_role', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('role_id')->nullable(false)->default(0)->comment('角色ID');
            $table->unsignedBigInteger('admin_id')->nullable(false)->default(0)->comment('管理员ID');
            $table->unique(['role_id', 'admin_id'], 'uk_role_admin_id');
            $table->comment('管理员角色表');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $this->schema()->dropIfExists('admin_role');
    }
};
