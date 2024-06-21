<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gg.lv',
            'password' => Hash::make('krigerts109'),  // Use a strong password in production
            'role' => 'admin'
        ]);
    }
}

