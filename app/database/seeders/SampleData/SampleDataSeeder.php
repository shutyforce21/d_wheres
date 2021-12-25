<?php

namespace Database\Seeders\SampleData;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SampleDataSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            [
                'code' => 'asdf1001',
                'name' => 'ダンサー１',
                'email' => 'asdf1@asdf.com',
                'password' => 'password'
            ],[
                'code' => 'asdf1002',
                'name' => 'ダンサー２',
                'email' => 'asdf2@asdf.com',
                'password' => 'password'
            ],
        ]);
    }

}
