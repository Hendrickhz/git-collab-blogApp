<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = fake()->sentence();
        $description = fake()->paragraph(50);
        return [
            "title" => $title,
            "slug" => Str::slug($title),
            "description" => $description,
            "excerpt" => Str::words($description, 50, '...'),
            "user_id" => rand(1, 11),
            "category_id" => rand(1, 5),
        ];
    }
}
