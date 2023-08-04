<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolUsuarioSeeder extends Seeder
{
    public function run() {
        DB::table('at_rol_usuario')->delete();
        $this->seedFromCSV(base_path('database/csv/rolusuarios.csv'));
    }

    private function seedFromCSV($filename, $separator = ';') {
        if (!file_exists($filename) || !is_readable($filename)) {
            return false;
        }

        if (($handle = fopen($filename, 'r')) !== false) {
            while (($row = fgetcsv($handle, 1000, $separator)) !== false) {
                DB::table('at_rol_usuario')->insert([
                    "n_id" => $row[0], 
                    "n_id_rol" => $row[1]
                ]);
            }

            fclose($handle);
        }
    }
}
