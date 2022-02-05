<?php


namespace Database\Seeders\InitData;

use App\Enums\RoleType as RoleEnums;
use App\Enums\PermissionType as PermissionEnums;
use App\Models\User;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Database\Seeder;

class RoleAndPermissionSeeder extends Seeder
{
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        foreach (PermissionEnums::getValues() as $permission) {
            Permission::create(['name' => $permission, 'guard_name' => 'admin_users']);
        }

        // Administrator
        Role::create(['name' => RoleEnums::Administrator, 'guard_name' => 'admin_users'])
            ->givePermissionTo([
                // Spots
                PermissionEnums::ReadSpots,
                PermissionEnums::EditSpots,
                // Users
                PermissionEnums::ReadUsers,
                PermissionEnums::EditUsers
            ]);

        // SuperAdministrator
        Role::create(['name' => RoleEnums::SuperAdministrator, 'guard_name' => 'admin_users'])
            ->givePermissionTo([
                // Spots
                PermissionEnums::ReadSpots,
                PermissionEnums::EditSpots,
                PermissionEnums::ActivateSpots,
                PermissionEnums::InActivateSpots,
                PermissionEnums::DeleteSpots,
                // Users
                PermissionEnums::ReadUsers,
                PermissionEnums::EditUsers,
                PermissionEnums::DeleteUsers,
            ]);
    }
}
