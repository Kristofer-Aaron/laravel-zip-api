<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\County;

class CountiesSeeder extends Seeder
{
    public function run(): void
    {
        $path = storage_path('app/megyek.csv');
        if (!file_exists($path)) {
            $this->command->error("CSV file could not be found: $path");
            return;
        }

        $handle = fopen($path, 'r');
        $count = 0;

        while (($row = fgetcsv($handle, 0, ',')) !== false) {
            $name = trim($row[0], "\xEF\xBB\xBF \t\n\r\0\x0B");

            // Skip rows with missing data
            if (!$name) continue; 

            County::firstOrCreate(['name' => $name]);

            $count++;
        }

        fclose($handle);
        $this->command->info("Import successful: {$count} counties loaded.");
    }
}
