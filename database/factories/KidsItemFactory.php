<?php

namespace Database\Factories;

use App\Models\KidsItem;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<KidsItem>
 */
class KidsItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->words(3, true),
            'slug' => fake()->unique()->slug(),
            'type' => 'food',
            'food_category' => null,
            'description' => fake()->sentence(),
            'image' => null,
            'price' => null,
            'sort_order' => 0,
            'status' => true,
        ];
    }
}
