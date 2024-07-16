<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SiteAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::factory()
        ->create([
            'name' => 'Cliford Pereira',
            'email' => 'cliford.pereira@gmail.com',
            'password' => Hash::make('password'),
        ]);

        $user->assignRole('site_admin');
    }
}
