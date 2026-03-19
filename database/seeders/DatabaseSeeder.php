<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Permits must exist before the admin user is created
        // so RoleRedirect can resolve on first login
        $this->call([
            AdminPermitSeeder::class,
            AdminUserSeeder::class,
        ]);
    }
}