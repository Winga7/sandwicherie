<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Appel du RoleSeeder en premier
        $this->call([
            RoleSeeder::class,        // Crée les rôles et permissions
            UserSeeder::class,        // Crée les utilisateurs
            PanidelProductsSeeder::class,
            DailySpecialSeeder::class,
        ]);
    }
}
