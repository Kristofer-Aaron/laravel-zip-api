<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\City;

class CitiesSeeder extends Seeder
{
    public function run(): void
    {
        $path = storage_path('app/iranyitoszamok.csv');
        if (!file_exists($path)) {
            $this->command->error("CSV file could not be found: $path");
            return;
        }

        $handle = fopen($path, 'r');
        $count = 0;

        while (($row = fgetcsv($handle, 0, ',')) !== false) {
            $zip = trim($row[0]);
            $name = trim($row[1]);
            $countyId = trim($row[2]);

            // Skip rows with missing data
            if (!$zip || !$name || !$countyId) continue;

            City::firstOrCreate(
                ['zip' => $zip, 'name' => $name],
                ['county_id' => $countyId]
            );

            $count++;
        }

        fclose($handle);
        $this->command->info("Import successful: {$count} cities loaded.");
    }
}
