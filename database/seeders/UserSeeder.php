<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Admin Ganteng',
            'email' => 'admin@gmail.com', // Ubah dengan email admin yang diinginkan
            'password' => Hash::make('admin12345'), // Ganti dengan password yang lebih aman
            'role' => 'admin', // Set role sebagai admin
        ]);
    }
}
