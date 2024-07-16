<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define the roles
        $roles = [
            'site_admin',
            'marketer',
            'tenant_admin',
            'customer',
            'worker',
        ];

        // Loop through the roles and create each one
        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role]);
        }
    }
}
