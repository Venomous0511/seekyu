<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'role_id' => 'app.' . $this->faker->numberBetween(1, 5),
            'role' => 'applicant',
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'status' => $this->faker->randomElement(['active', 'inactive', 'pending']),
            'password' => bcrypt('password123'),
        ];
    }

    /**
     * Role states
     */
    public function superAdmin()
    {
        return $this->state(fn() => [
            'role_id' => 'sa.' . $this->faker->numberBetween(1, 5),
            'role' => 'Super Admin',
            'name' => 'Main Super Admin',
            'status' => 'active',
            'password' => bcrypt('superadmin123'),
            'email' => 'superadmin@example.com',
        ]);
    }
}
