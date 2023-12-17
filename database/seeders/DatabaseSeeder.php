<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            // Seeder for Types
            TypesSeeder::class,
            // Seeder for Roles
            RoleSeeder::class,
            // Seeder for Users
            UserSeeder::class,
            // Seeder for SU
            SuperAdminSeeder::class,
        ]);
    }
}
