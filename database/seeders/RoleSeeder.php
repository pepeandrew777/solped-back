<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    public function run() {
        DB::table('at_roles')->delete();
        $this->seedFromCSV(base_path('database/csv/roles.csv'));
    }

    private function seedFromCSV($filename, $separator = ';') {
        if (!file_exists($filename) || !is_readable($filename)) {
            return false;
        }

        if (($handle = fopen($filename, 'r')) !== false) {
            while (($row = fgetcsv($handle, 1000, $separator)) !== false) {
                DB::table('at_roles')->insert([
                    "v_nombre_rol" => $row[0], 
                    "v_nombre_mostrar_rol" => $row[1],
                    "v_descripcion_rol" => $row[2]
                ]);
            }

            fclose($handle);
        }
    }
}
