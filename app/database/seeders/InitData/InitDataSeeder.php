<?php


namespace Database\Seeders\InitData;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InitDataSeeder extends Seeder
{
    public function run()
    {
        DB::table('prefectures')->insert([
            ['name' => '北海道'],
            ['name' => '東京'],
            ['name' => '神奈川'],
            ['name' => '大阪'],
            ['name' => '沖縄']
        ]);

        DB::table('genres')->insert([
            ['name' => 'HipHop'],
            ['name' => 'Breakin'],
            ['name' => 'Popin'],
            ['name' => 'Jazz'],
            ['name' => 'Krump'],
            ['name' => 'R&B'],
            ['name' => 'Wack'],
            ['name' => 'House'],
        ]);
    }

}
