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

        DB::table('spots')->insert([
            [
                'code' => 'asdfasdf12341234',
                'name' => '池袋駅東口1',
                'image' => 'storage/spot/61cffe77d3e74/main/captain-cat.jpg',
                'prefecture_id' => 1,
                'address' => '東京都池袋1-2-1',
                'content' => '内容内容',
                'location' => DB::raw('ST_GeomFromText("POINT(12.12341234 12.12341234)")'),
                'open_on' => '12:23:45',
                'close_on' => '12:23:45',
                'create_user_id' => 1
            ],[
                'code' => 'asdfasdf123412341',
                'name' => '池袋駅東口2',
                'image' => 'storage/spot/61cffe77d3e74/main/captain-cat.jpg',
                'prefecture_id' => 2,
                'address' => '東京都池袋1-2-1',
                'content' => '内容内容',
                'location' => DB::raw('ST_GeomFromText("POINT(12.12341234 12.12341234)")'),
                'open_on' => '12:23:45',
                'close_on' => '12:23:45',
                'create_user_id' => 1
            ],[
                'code' => 'asdfasdf123412342',
                'name' => '池袋駅東口3',
                'image' => 'storage/spot/61cffe77d3e74/main/captain-cat.jpg',
                'prefecture_id' => 1,
                'address' => '東京都池袋1-2-1',
                'content' => '内容内容',
                'location' => DB::raw('ST_GeomFromText("POINT(12.12341234 12.12341234)")'),
                'open_on' => '12:23:45',
                'close_on' => '12:23:45',
                'create_user_id' => 1
            ],[
                'code' => 'asdfasdf123412343',
                'name' => '池袋駅東口4',
                'image' => 'storage/spot/61cffe77d3e74/main/captain-cat.jpg',
                'prefecture_id' => 2,
                'address' => '東京都池袋1-2-1',
                'content' => '内容内容',
                'location' => DB::raw('ST_GeomFromText("POINT(12.12341234 12.12341234)")'),
                'open_on' => '12:23:45',
                'close_on' => '12:23:45',
                'create_user_id' => 1
            ],[
                'code' => 'asdfasdf123412344',
                'name' => '池袋駅東口5',
                'image' => 'storage/spot/61cffe77d3e74/main/captain-cat.jpg',
                'prefecture_id' => 1,
                'address' => '東京都池袋1-2-1',
                'content' => '内容内容',
                'location' => DB::raw('ST_GeomFromText("POINT(12.12341234 12.12341234)")'),
                'open_on' => '12:23:45',
                'close_on' => '12:23:45',
                'create_user_id' => 1
            ],[
                'code' => 'asdfasdf123412345',
                'name' => '池袋駅東口6',
                'image' => 'storage/spot/61cffe77d3e74/main/captain-cat.jpg',
                'prefecture_id' => 2,
                'address' => '東京都池袋1-2-1',
                'content' => '内容内容',
                'location' => DB::raw('ST_GeomFromText("POINT(12.12341234 12.12341234)")'),
                'open_on' => '12:23:45',
                'close_on' => '12:23:45',
                'create_user_id' => 1
            ],[
                'code' => 'asdfasdf123412346',
                'name' => '池袋駅東口7',
                'image' => 'storage/spot/61cffe77d3e74/main/captain-cat.jpg',
                'prefecture_id' => 1,
                'address' => '東京都池袋1-2-1',
                'content' => '内容内容',
                'location' => DB::raw('ST_GeomFromText("POINT(12.12341234 12.12341234)")'),
                'open_on' => '12:23:45',
                'close_on' => '12:23:45',
                'create_user_id' => 1
            ]
        ]);
    }

}
