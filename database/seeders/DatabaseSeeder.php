<?php

namespace Database\Seeders;

use App\Models\MeetingRoom;
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

        // $roles = [
        //     ['name' => 'admin'],
        //     ['name' => 'user'],
        // ];

        // foreach ($roles as $role) {
        //     \App\Models\Role::create($role);
        // }

        User::create([
            'google_id' => 100395478869342092533,
            'image' => 'https://lh3.googleusercontent.com/a/ACg8ocJEPNHMLaJM__vHd4Xn12WTTknD2SH1Gv8FVSH7GYIkAgSKHYY=s96-c',
            'name' => 'PSGA MALIKI ADMIN',
            'email' => 'psgamaliki@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('password'),
            'number_phone' => '085134517160',
            'otp' => rand(100000, 999999),
            'number_phone_verified_at' => now(),
            'is_admin' => true,
        ]);
    }
}
