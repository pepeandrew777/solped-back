<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run() {
        DB::table('at_usuarios')->delete();
        $this->seedFromCSV(base_path('database/csv/usuarios.csv'));
    }
   

    private function seedFromCSV($filename, $separator = ';') {
        if (!file_exists($filename) || !is_readable($filename)) {
            return false;
        }

        if (($handle = fopen($filename, 'r')) !== false) {
            while (($row = fgetcsv($handle, 1000, $separator)) !== false) {
                DB::table('at_usuarios')->insert([
                    "v_usuario" => $row[0],
                    "v_nombres" => $row[1],
                    "v_apellido_paterno" => $row[2],
                    "v_apellido_materno" => $row[3],
                    "v_cargo" => $row[4],
                    "v_ci" => $row[5],
                    "v_email" => $row[6],
                    "v_password" => Hash::make($row[7]),
                ]);
            }

            fclose($handle);
        }
    }
              
}
