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
        // Création des rôles ✨
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $orderManagerRole = Role::firstOrCreate(['name' => 'order_manager']);
        $userRole = Role::firstOrCreate(['name' => 'user']);

        // Création de l'admin 👑
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password123')
        ]);
        $admin->assignRole('admin');

        // Création du responsable de commande 📋
        $orderManager = User::create([
            'name' => 'Responsable Commandes',
            'email' => 'manager@example.com',
            'password' => Hash::make('password123')
        ]);
        $orderManager->assignRole('order_manager');

        // Création de l'utilisateur normal 🌟
        $user = User::create([
            'name' => 'Utilisateur',
            'email' => 'user@example.com',
            'password' => Hash::make('password123')
        ]);
        $user->assignRole('user');
    }
}
