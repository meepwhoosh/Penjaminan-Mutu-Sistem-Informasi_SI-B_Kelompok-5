<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Hewan>
 */
class HewanFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nama' => fake()->firstName() . ' ' . fake()->word(),
            'jenis' => fake()->randomElement(['Kucing', 'Anjing', 'Kelinci']),
            'ras' => fake()->word(),
            'deskripsi' => fake()->sentence(),
            'usia' => fake()->numberBetween(1, 10),
            'foto' => null,
            'status' => 'tersedia',
        ];
    }
}
