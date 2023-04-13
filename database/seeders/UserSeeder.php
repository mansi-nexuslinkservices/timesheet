<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();
        $role1 = Role::create(['name' => 'admin']);
        $role2 = Role::create(['name' => 'project manager']);
        $role3 = Role::create(['name' => 'team leader']);
        $role4 = Role::create(['name' => 'employee']);
        $role5 = Role::create(['name' => 'admin-user']);


        $user = User::create([
            'name' => "Admin",
            'surname' => "Panel",
            'email' => "superadmin@admin.com",
            'password' => Hash::make('12345678'),
            'super_admin' => 1,
            'status' => 1,
        ]);

        $user->assignRole($role1);
    }
}
