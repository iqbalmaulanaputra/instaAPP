<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Demo User',
            'username' => 'demouser',
            'email' => 'demo@instaapp.test',
            'password' => Hash::make('password'),
            'bio' => 'Selamat datang di InstaApp! 🚀',
        ]);

        User::factory()->count(12)->create();
    }
}
