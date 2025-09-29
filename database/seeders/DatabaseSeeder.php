<?php

namespace Database\Seeders;

use App\Models\Pelaporan;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $roles = [
            ['name' => 'admin'],
            ['name' => 'user'],
        ];

        foreach ($roles as $role) {
            \App\Models\Role::create($role);
        }

        User::create([
            'google_id' => 116200948077420596486,
            'name' => 'Rifky Aryo',
            'email' => '220605110052@student.uin-malang.ac.id',
            'number_phone' => '6285794433959',
            'otp' => rand(100000, 999999),
            'email_verified_at' => now(),
            'is_admin' => true,
            'password' => bcrypt('password'),
        ]);
    }
}
