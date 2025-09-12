<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Server>
 */
class ServerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => 'server-' . $this->faker->unique()->numberBetween(1, 50000),
            'ip_address' => '10.' . $this->faker->numberBetween(0, 255) . '.' . $this->faker->numberBetween(0, 255) . '.' . $this->faker->numberBetween(1, 254),
            'provider' => $this->faker->randomElement(['aws', 'digitalocean', 'vultr', 'other']),
            'status' => $this->faker->randomElement(['active', 'inactive', 'maintenance']),
            'cpu_cores' => $this->faker->numberBetween(1, 32),
            'ram_mb' => $this->faker->randomElement([512, 1024, 2048, 4096, 8192]),
            'storage_gb' => $this->faker->numberBetween(20, 2000),
        ];
    }
}
