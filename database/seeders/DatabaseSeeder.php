<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create one Super Admin
        User::factory()->superAdmin()->create();

        // Create some Admins
        User::factory()->count(2)->admin()->create();

        // Create some HRs
        User::factory()->count(2)->hr()->create();

        // Create Head Security Guards
        User::factory()->count(2)->headSecurityGuard()->create();

        // Create Security Guards
        User::factory()->count(5)->securityGuard()->create();

        // Create Clients
        User::factory()->count(5)->client()->create();

        // Create Applicants
        User::factory()->count(5)->create();
    }
}
