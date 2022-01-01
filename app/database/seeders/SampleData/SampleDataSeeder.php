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
                'name' => 'ダンサー1',
                'email' => 'asdf1@asdf.com',
                'password' => 'password'
            ],[
                'code' => 'asdf1002',
                'name' => 'ダンサー2',
                'email' => 'asdf2@asdf.com',
                'password' => 'password'
            ],[
                'code' => 'asdf1003',
                'name' => 'ダンサー3',
                'email' => 'asdf3@asdf.com',
                'password' => 'password'
            ],[
                'code' => 'asdf1004',
                'name' => 'ダンサー4',
                'email' => 'asdf4@asdf.com',
                'password' => 'password'
            ],[
                'code' => 'asdf1005',
                'name' => 'ダンサー5',
                'email' => 'asdf5@asdf.com',
                'password' => 'password'
            ],
        ]);

//        DB::table('spots')->insert([
//            [
//                'name' => '池袋駅東口',
//                'image' => 'storage/'
//                'prefecture_id'
//                'address'
//                'location'
//                'open_on'
//                'close_on'
//                'create_user_id'
//            ],[
//
//            ]
//        ]);
    }

}
