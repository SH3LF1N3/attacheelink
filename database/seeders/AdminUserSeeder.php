<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@attachke.ac.ke'],
            [
                'uname'    => 'admin',
                'fname'    => 'System Administrator',
                'email'    => 'admin@attachke.ac.ke',
                'phone'    => '+254700000000',
                'role'     => 'admin',
                'gender'   => 'Male',
                'password' => Hash::make('Admin@1234'),
            ]
        );
    }
}