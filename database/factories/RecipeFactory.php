<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Recipe>
 */
class RecipeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->sentence,
            'description' => fake()->paragraph,
            'ingredients' => fake()->text,
            'instructions' => fake()->text,
            'image' => '1705476809.jpg',
            'category_id' => fake()->numberBetween(1, 8),
            'difficulty' => fake()->randomElement([1, 2, 3, 4]),
            'cooking_time' => fake()->numberBetween(10, 120),
            'video_url' => optional(fake()->boolean(50), function ($shouldHaveUrl) {
                return $shouldHaveUrl ? 'https://www.youtube.com/watch?v=1-SJGQ2HLp8' : null;
            }),
            'user_id' => fake()->numberBetween(1, 11),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
