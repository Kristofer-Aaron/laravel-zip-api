<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed counties first
        $this->call(CsvCountiesSeeder::class);

        // Then cities (depends on counties)
        $this->call(CsvCitiesSeeder::class);
    }
}
