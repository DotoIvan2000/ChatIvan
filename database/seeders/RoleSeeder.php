<?php

namespace Database\Seeders;

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
    }
}
