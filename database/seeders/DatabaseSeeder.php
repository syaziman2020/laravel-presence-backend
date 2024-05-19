<?php

namespace Database\Seeders;

use App\Models\Attendance;
use App\Models\Company;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(20)->create();

        User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('rahasia123'),
            'phone' => '12345678',
            'role' => 'admin',
            'remember_token' => Str::random(10),
            'email_verified_at' => now(),
        ]);

        Company::create([
            'name' => 'PT TEST FIC',
            'email' => 'admin@example.com',
            'address' => 'Jl. Raya Kedung Turi No. 20, Sleman, DIY',
            'latitude' => '-7.747033',
            'longitude' => '110.355398',
            'radius_km' => '0.5',
            'time_in' => '2023-05-12 08:23:17',
            'time_out' => '2023-05-12 17:00:00'
        ]);

        Attendance::factory(20)->create();
    }
}
