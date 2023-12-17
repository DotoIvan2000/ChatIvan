<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'create-team',
            'update-team',
            'delete-team',
        ];
        $role = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'api']);
        foreach ($permissions as $permissionName) {
            $permission = Permission::findOrCreate($permissionName, 'api');
            if ($permission) {
                $role->givePermissionTo($permission);
            }
        }

        $permissionsSuperAdmin = 'super-admin-permission';
        $superAdminRole = Role::firstOrCreate(['name' => 'super-admin-role', 'guard_name' => 'api']);
        $superAdminPermission = Permission::findOrCreate($permissionsSuperAdmin, 'api');
        if ($superAdminPermission) {
            $superAdminRole->givePermissionTo($superAdminPermission);
        }
    }
}
