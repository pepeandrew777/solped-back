<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuSeeder extends Seeder
{
    public function run() {
        DB::table('at_menus')->delete();
        $this->seedFromCSV(base_path('database/csv/menu.csv'));
    }

    private function seedFromCSV($filename, $separator = ';') {
        if (!file_exists($filename) || !is_readable($filename)) {
            return false;
        }

        if (($handle = fopen($filename, 'r')) !== false) {
            while (($row = fgetcsv($handle, 1000, $separator)) !== false) {
                DB::table('at_menus')->insert([
                    "v_nombre" => $row[0], 
                    "v_rastro" => $row[1],
                    "n_padre" => $row[2],
                    "n_orden" => $row[3], 
                    "b_activado" => $row[4],
                    "v_icono" => $row[5]
                ]);
            }

            fclose($handle);
        }
    }
}
