<?php

namespace Database\Seeders\SampleData;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use function Webmozart\Assert\Tests\StaticAnalysis\uuid;

class SampleDataSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            [
                'code' => 'a1s2d3f1001',
                'email' => 'asdf1@asdf.com',
                'password' => Hash::make('password')
            ],[
                'code' => 'a1s2d3f1002',
                'email' => 'asdf2@asdf.com',
                'password' => Hash::make('password')
            ],[
                'code' => 'a1s2d3f1003',
                'email' => 'asdf3@asdf.com',
                'password' => Hash::make('password')
            ],[
                'code' => 'a1s2d3f1004',
                'email' => 'asdf4@asdf.com',
                'password' => Hash::make('password')
            ],[
                'code' => 'a1s2d3f1005',
                'email' => 'asdf5@asdf.com',
                'password' => Hash::make('password')
            ],
        ]);

        DB::table('profiles')->insert([
            [
                'user_id' => 1,
                'user_code' => uniqid(),
                'name' => 'test dancer1',
                'image' => "/image/sample/user.jpg",
                'background' => "/image/sample/background.jpg",
                'biography' => "Thank you coming my page!!\nThis is my dance profile and I like HipHop, Breakin"
            ]
        ]);

        DB::table('profiles')->insert([
            [
                'user_id' => 2,
                'user_code' => uniqid(),
                'name' => 'test dancer2',
            ],[
                'user_id' => 3,
                'user_code' => uniqid(),
                'name' => 'test dancer3',
            ],[
                'user_id' => 4,
                'user_code' => uniqid(),
                'name' => 'test dancer4',
            ],[
                'user_id' => 5,
                'user_code' => uniqid(),
                'name' => 'test dancer5',
            ]
        ]);

        DB::table('user_genre')->insert([
            ['user_id' => 1, 'genre_id' => 1],
            ['user_id' => 1, 'genre_id' => 2],
            ['user_id' => 1, 'genre_id' => 3],
        ]);

        DB::table('follows')->insert([
            ['follower_id' => 1, 'followed_id' => 2],
            ['follower_id' => 1, 'followed_id' => 3],
            ['follower_id' => 1, 'followed_id' => 4],
            ['follower_id' => 2, 'followed_id' => 1],
            ['follower_id' => 2, 'followed_id' => 3],
            ['follower_id' => 2, 'followed_id' => 4],
            ['follower_id' => 3, 'followed_id' => 1],
            ['follower_id' => 3, 'followed_id' => 2],
            ['follower_id' => 3, 'followed_id' => 4],
            ['follower_id' => 4, 'followed_id' => 1],
            ['follower_id' => 4, 'followed_id' => 2],
            ['follower_id' => 4, 'followed_id' => 3],
        ]);

        for ($i=1;$i<50;$i++) {
            $spots[] = [
                'code' => 'asdfasdf1234'.$i,
                'name' => '池袋駅東口'. $i,
                'image' => '/image/sample/spot.jpg',
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
