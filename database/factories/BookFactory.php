<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => $this->faker->unique()->sentence(3),
            'author' => $this->faker->name,
            'published_year' => $this->faker->year,
            'average_rating' => $this->faker->randomFloat(1, 0, 5),
            'ratings_count' => $this->faker->numberBetween(0, 1000),
            'description' => $this->faker->paragraph,
            'cover_image' => null,
        ];
    }
}
