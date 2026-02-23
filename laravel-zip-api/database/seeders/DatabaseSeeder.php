<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Seed users
        $this->call(UserSeeder::class);

        // Seed counties and cities tables
        $this->call(CountiesSeeder::class);
        $this->call(CitiesSeeder::class);
    }
}
