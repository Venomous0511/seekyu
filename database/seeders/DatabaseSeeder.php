<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create Super Admin
        User::factory(2)->superAdmin()->create();

        // Create Admins
        User::factory(5)->admin()->create();

        // Create HRs
        User::factory(5)->hr()->create();

        // Create Head Security Guards
        User::factory(5)->headSecurityGuard()->create();

        // Create Security Guards
        User::factory(20)->securityGuard()->create();

        // Create Clients
        User::factory(10)->client()->create();

        // Create Applicants
        User::factory()->create();
    }
}
