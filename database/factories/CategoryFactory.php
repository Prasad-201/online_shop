<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(), // Use "$this->faker->name()" instead of "fake()->name()"
            'status' => $this->faker->randomElement([0, 1]), // Use "$this->faker->randomElement()" instead of "rand()"
            'slug' => $this->faker->unique()->slug(), // Use "$this->faker->unique()->slug()" for a unique slug
        ];
    }
}
