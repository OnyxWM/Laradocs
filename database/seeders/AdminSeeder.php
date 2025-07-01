<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {

        $admin = [
            'name' => 'admin',
            'email' => 'admin@user.com',
            'role' => 'admin',
            'password' => Hash::make('password'),
        ];

        User::updateOrCreate($admin);
    }
}
