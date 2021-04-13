<?php

namespace Database\Seeders;

use App\Models\People;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        People::factory()
                ->count(100)
                ->hasPoints(100)
                ->create();
    }
}
