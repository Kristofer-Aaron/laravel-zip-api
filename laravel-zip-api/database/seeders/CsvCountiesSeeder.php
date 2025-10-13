<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\County;

class CsvCountiesSeeder extends Seeder
{
    public function run(): void
    {
        $path = storage_path('app/megyek.csv');
        if (!file_exists($path)) {
            $this->command->error("CSV fájl nem található: $path");
            return;
        }

        $handle = fopen($path, 'r');
        $count = 0;

        while (($row = fgetcsv($handle, 0, ',')) !== false) {
            $name = trim($row[0]);

            County::firstOrCreate([
                'name' => $name,
            ]);

            $count++;
        }

        fclose($handle);
        $this->command->info("Import sikeres: {$count} megye betöltve.");
    }
}
