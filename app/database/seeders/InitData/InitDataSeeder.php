<?php


namespace Database\Seeders\InitData;


use App\Enums\RoleType;
use App\Models\AdminUser;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InitDataSeeder extends Seeder
{
    public function run()
    {
        //総合管理者
        AdminUser::create([
            'email' => env('SUPER_ADMINISTRATOR_EMAIL'),
            'password' => env('SUPER_ADMINISTRATOR_PASSWORD')
        ])->assignRole(RoleType::SuperAdministrator);

        //管理者
        AdminUser::create([
            'email' => env('ADMINISTRATOR_EMAIL'),
            'password' => env('ADMINISTRATOR_PASSWORD')
        ])->assignRole(RoleType::Administrator);


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
