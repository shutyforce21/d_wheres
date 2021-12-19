<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'code' => 'asdf1234',
                'name' => 'asdf',
                'email' => 'asdf@asdf.com',
                'password' => 'Aasdf1234@',
                'sns_links' => 'asdf'
            ],
        ]);

        DB::table('prefectures')->insert([
            ['name' => '東京'],
            ['name' => '北海道']
        ]);
    }
}
