<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Log;

class RoleSeeder extends Seeder
{
    public function run()
    {
        Log::info('Début du RoleSeeder');

        try {
            // Créer les rôles
            $adminRole = Role::firstOrCreate(['name' => 'admin']);
            Log::info('Rôle admin créé', ['role' => $adminRole]);

            $orderManagerRole = Role::firstOrCreate(['name' => 'order_manager']);
            Log::info('Rôle order_manager créé', ['role' => $orderManagerRole]);

            $userRole = Role::firstOrCreate(['name' => 'user']);
            Log::info('Rôle user créé', ['role' => $userRole]);

            // Créer les permissions
            $permissions = [
                'invite employees',
                'manage menu',
                'assign order manager',
                'view all orders',
                'receive daily orders',
                'manage daily orders',
                'track payments',
                'view user accounts',
                'select sandwiches',
                'view order history',
                'track own payments'
            ];

            foreach ($permissions as $permission) {
                $perm = Permission::firstOrCreate(['name' => $permission]);
                Log::info('Permission créée', ['permission' => $perm]);
            }

            // Assigner les permissions aux rôles
            $adminRole->givePermissionTo(['invite employees', 'manage menu', 'assign order manager', 'view all orders']);
            $orderManagerRole->givePermissionTo(['receive daily orders', 'manage daily orders', 'track payments', 'view user accounts']);
            $userRole->givePermissionTo(['select sandwiches', 'view order history', 'track own payments']);

            Log::info('Fin du RoleSeeder avec succès');
        } catch (\Exception $e) {
            Log::error('Erreur dans RoleSeeder', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            throw $e;
        }
    }
}
