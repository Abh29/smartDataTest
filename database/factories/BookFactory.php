<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'author_id' => rand(1, 12),
            'title' => fake()->sentence('4'),
            'description' => fake()->text(200),
            'publisher' => fake()->company(),
            'edition' => 'edition_1',
            'printed_at' => fake()->date(),
            'language' => array_rand(['en', 'fr', 'ru'], 1),
            'pages_count' => rand(100, 500),
            'rating' => rand(1, 5),
        ];
    }
}
