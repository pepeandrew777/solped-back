<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {
    public function run () {
        $this->call(MenuSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(RolUsuarioSeeder::class);
        $this->call(PermisoSeeder::class);
    }
}
