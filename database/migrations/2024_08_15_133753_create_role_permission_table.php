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
        $this->schema()->create('role_permission', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('role_id')->nullable(false)->default(0)->comment('角色ID');
            $table->unsignedBigInteger('permission_id')->nullable(false)->default(0)->comment('权限ID');
            $table->unique(['role_id', 'permission_id'], 'uk_role_permission_id');
            $table->comment('角色权限表');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $this->schema()->dropIfExists('role_permission');
    }
};
