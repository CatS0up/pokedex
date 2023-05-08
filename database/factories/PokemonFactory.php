<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pokemon>
 */
class PokemonFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'pokeapi_id' => fake()->unique()->numberBetween(),
            'name' => fake()->unique()->word(),
            'sprite_url' => fake()->imageUrl(),
            'weight' => fake()->numberBetween(1, 255),
            'height' => fake()->numberBetween(1, 255),
        ];
    }
}
