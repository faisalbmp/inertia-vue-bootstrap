<?php

namespace Database\Seeders;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Seeder;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Superadmin Role
        $superadminRole = Role::create(['name' => 'superadmin']);

        // Create Superadmin User
        $user = User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('admin'), // Use hashed password
        ]);

        // Assign Role to Superadmin User
        $user->assignRole($superadminRole);
    }
}
