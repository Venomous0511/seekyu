<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create Super Admin
        User::factory(1)->superAdmin()->create();

        // Create Admins
        User::factory(1)->admin()->create();

        // Create HRs
        User::factory(1)->hr()->create();

        // Create Head Security Guards
        User::factory(1)->headSecurityGuard()->create();

        // Create Security Guards
        User::factory(4)->securityGuard()->create();

        // Create Clients
        User::factory(2)->client()->create();

        // Create Applicants
        User::factory()->create();
    }
}
