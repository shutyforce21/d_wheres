<?php

namespace Database\Seeders\SampleData;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SampleDataSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            [
                'code' => 'asdf1001',
                'name' => 'ダンサー1',
                'email' => 'asdf1@asdf.com',
                'password' => Hash::make('password')
            ],[
                'code' => 'asdf1002',
                'name' => 'ダンサー2',
                'email' => 'asdf2@asdf.com',
                'password' => Hash::make('password')
            ],[
                'code' => 'asdf1003',
                'name' => 'ダンサー3',
                'email' => 'asdf3@asdf.com',
                'password' => Hash::make('password')
            ],[
                'code' => 'asdf1004',
                'name' => 'ダンサー4',
                'email' => 'asdf4@asdf.com',
                'password' => Hash::make('password')
            ],[
                'code' => 'asdf1005',
                'name' => 'ダンサー5',
                'email' => 'asdf5@asdf.com',
                'password' => Hash::make('password')
            ],
        ]);

        for ($i=1;$i<50;$i++) {
            $spots[] = [
                'code' => 'asdfasdf1234'.$i,
                'name' => '池袋駅東口'. $i,
                'image' => 'storage/spot/61cffe77d3e74/main/captain-cat.jpg',
                'prefecture_id' => rand(1,2),
                'address' => '東京都池袋1-2-1',
                'content' => 'こちらに練習場所の詳細を記載できます。',
                'location' => DB::raw('ST_GeomFromText("POINT(12.12341234 12.12341234)")'),
                'open_on' => '12:23:45',
                'close_on' => '12:23:45',
                'create_user_id' => rand(1,2)
            ] ;
        }
        DB::table('spots')->insert($spots);
    }

}
