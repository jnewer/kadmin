<?php

namespace  database\seeders;

use support\Db;
use Eloquent\Migrations\Seeds\Seeder;

class CreateAdminAccount extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() :void
    {
        Db::table('admin')->insert([
            'username' => 'admin',
            'nickname' => '超级管理员',
            'password' => password_hash('123456', PASSWORD_DEFAULT),
            'email' => 'admin@admin.com',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
    }
}
