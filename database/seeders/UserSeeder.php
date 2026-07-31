<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            "nama" => "Administrator",
            "username" => "admin_123!",
            "role" => "Admin",
            "password" => bcrypt("password_123!")
        ]);

        User::create([
            "nama" => "Supervisor",
            "username" => "spv_123!",
            "role" => "Supervisor",
            "password" => bcrypt("spv_123!")
        ]);
    }
}
