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
        User::factory()->count(1)->admin()->create();

        // Create some HRs
        User::factory()->count(1)->hr()->create();

        // Create Head Security Guards
        User::factory()->count(1)->headSecurityGuard()->create();

        // Create Security Guards
        User::factory()->count(1)->securityGuard()->create();

        // Create Clients
        User::factory()->count(1)->client()->create();

        // Create Applicants
        User::factory()->count(1)->create();
    }
}
