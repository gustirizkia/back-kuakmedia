<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
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
    public function definition()
    {
        $title = $this->faker->sentence;
        $slug = Str::slug($title, '-');
        return [
            'user_id' => $this->faker->numberBetween($min = 1, $max = 20),
            'category_id' => $this->faker->numberBetween($min = 1, $max = 14),
            'image' => $this->faker->imageUrl($width = 640, $height = 480),
            'judul' => $title,
            'body' => $this->faker->realText($maxNbChars = 1000, $indexSize = 2),
            'publish' => 'yes',
            // 'slug' => $slug
        ];
    }
}
