<?php

use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * 后台帐号
     * php artisan db:seed --class=AdminSeeder
     *
     * @return void
     */
    public function run()
    {
        // DB::table('admins')->delete();

        $now = date('Y-m-d H:i:s');
        $password = bcrypt('123456');
        $users = [
            [
                'id' => null,
                'name' => '超级管理员',
                'email' => 'admin@qq.com',
                'password' => $password,
                'avatar' => '',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        DB::table('admins')->insert($users);
    }
}
