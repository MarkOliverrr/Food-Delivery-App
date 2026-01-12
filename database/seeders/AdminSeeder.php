<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        Admin::create([
            'username' => 'ccbd',
            'password' => 'ccbd123', // Will be hashed automatically
            'email' => 'admin@gmail.com',
            'code' => '',
        ]);
    }
}

