<?php

namespace  database\seeders;

use Eloquent\Migrations\Seeds\Seeder;
use support\Db;

class CreateSuperUserRole extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        Db::table('role')->insert([
            'pid' => 0,
            'name' => 'super_admin',
            'display_name' => '超级管理员',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
