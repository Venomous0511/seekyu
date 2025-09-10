<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    public function definition(): array
    {
        return [
            'role_id' => 'app.' . $this->faker->unique()->numberBetween(100, 999),
            'role' => 'applicant',
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => Hash::make('password123'), // default password for testing
        ];
    }

    /**
     * Role states
     */
    public function superAdmin()
    {
        return $this->state(fn() => [
            'role_id' => 'sa.001',
            'role' => 'super_admin',
            'name' => 'Main Super Admin',
            'email' => 'superadmin@example.com',
        ]);
    }

    public function admin()
    {
        return $this->state(fn() => [
            'role_id' => 'adm.' . $this->faker->unique()->numberBetween(1, 99),
            'role' => 'admin',
        ]);
    }

    public function hr()
    {
        return $this->state(fn() => [
            'role_id' => 'hr.' . $this->faker->unique()->numberBetween(1, 99),
            'role' => 'hr',
        ]);
    }

    public function securityGuard()
    {
        return $this->state(fn() => [
            'role_id' => 'sg.' . $this->faker->unique()->numberBetween(100, 999),
            'role' => 'security_guard',
        ]);
    }

    public function headSecurityGuard()
    {
        return $this->state(fn() => [
            'role_id' => 'hsg.' . $this->faker->unique()->numberBetween(1, 50),
            'role' => 'head_security_guard',
        ]);
    }

    public function client()
    {
        return $this->state(fn() => [
            'role_id' => 'c.' . $this->faker->unique()->numberBetween(1000, 9999),
            'role' => 'client',
        ]);
    }
}
