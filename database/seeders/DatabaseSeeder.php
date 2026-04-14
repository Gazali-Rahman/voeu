<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Buat Role (Admin dan User)
        $adminRole = Role::create(['name' => 'admin']);
        $userRole = Role::create(['name' => 'user']);

        // 2. Buat Akun Admin Utama
        $admin = User::create([
            'name' => 'gazali',
            'email' => 'admin@voeu.id', // Silakan ganti sesuai keinginan
            'password' => Hash::make('password'), // Ganti dengan password yang aman
            'email_verified_at' => now(),
        ]);

        // Tempelkan role admin ke user ini
        $admin->assignRole($adminRole);

        // 3. Buat Akun Test User Biasa (Opsional)
        $testUser = User::create([
            'name' => 'Test Customer',
            'email' => 'user@example.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]);

        $testUser->assignRole($userRole);

        $this->command->info('Admin and Test User seeded successfully!');
    }
}
