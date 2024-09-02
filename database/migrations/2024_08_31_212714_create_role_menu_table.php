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
        $this->schema()->create('role_menu', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('role_id')->nullable(false)->default(0)->comment('角色ID');
            $table->unsignedBigInteger('menu_id')->nullable(false)->default(0)->comment('菜单ID');
            $table->unique(['role_id', 'menu_id'], 'uk_role_menu');
            $table->comment('角色菜单表');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $this->schema()->dropIfExists('role_menu');
    }
};
