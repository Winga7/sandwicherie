<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    public function run()
    {
        // Créer les rôles
        $adminRole = Role::create(['name' => 'admin']);
        $orderManagerRole = Role::create(['name' => 'order_manager']);
        $userRole = Role::create(['name' => 'user']);

        // Créer les permissions
        Permission::create(['name' => 'invite employees']);
        Permission::create(['name' => 'manage menu']);
        Permission::create(['name' => 'assign order manager']);
        Permission::create(['name' => 'view all orders']);
        Permission::create(['name' => 'receive daily orders']);
        Permission::create(['name' => 'manage daily orders']);
        Permission::create(['name' => 'track payments']);
        Permission::create(['name' => 'view user accounts']);
        Permission::create(['name' => 'select sandwiches']);
        Permission::create(['name' => 'view order history']);
        Permission::create(['name' => 'track own payments']);

        // Assigner les permissions aux rôles
        $adminRole->givePermissionTo(['invite employees', 'manage menu', 'assign order manager', 'view all orders']);
        $orderManagerRole->givePermissionTo(['receive daily orders', 'manage daily orders', 'track payments', 'view user accounts']);
        $userRole->givePermissionTo(['select sandwiches', 'view order history', 'track own payments']);
    }
}
