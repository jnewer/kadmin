<?php

namespace  database\seeders;

use support\Db;
use Eloquent\Migrations\Seeds\Seeder;

class CreateUserAccount extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() :void
    {
        Db::table('user')->insert([
            'username' => 'user',
            'nickname' => '超级用户',
            'password' => password_hash('123456', PASSWORD_DEFAULT),
            'email' => 'user@user.com',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
    }
}
