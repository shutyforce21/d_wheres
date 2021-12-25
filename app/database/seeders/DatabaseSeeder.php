<?php

namespace Database\Seeders;

use Database\Seeders\InitData\InitDataSeeder;
use Database\Seeders\SampleData\SampleDataSeeder;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     * @return void
     */
    public function run()
    {
        $this->call([
            InitDataSeeder::class
        ]);

        if (config('app.env') == "local" || config('app.env') == "test" || config('app.env') == "develop") {
            $this->call([
                SampleDataSeeder::class
            ]);
        }
    }
}
