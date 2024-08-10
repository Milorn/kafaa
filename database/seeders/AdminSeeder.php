<?php

namespace Database\Seeders;

use App\Enums\UserType;
use App\Models\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'fname' => 'Admin',
            'lname' => 'Admin',
            'email' => 'admin@kafaa.com',
            'password' => 'kafaa@2024',
            'type' => UserType::Admin,
        ]);
    }
}
