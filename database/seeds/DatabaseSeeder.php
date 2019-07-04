<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * 运行数据库填充
     * php artisan db:seed
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            AdminSeeder::class,
            MenuSeeder::class,
        ]);
    }
}
