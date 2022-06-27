<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ShareArticle>
 */
class ShareArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'article_id' => $this->faker->numberBetween($min = 1, $max = 30),
            'jumlah' => $this->faker->numberBetween($min = 100, $max = 1000),
            'platform' => $this->faker->randomElement($array = array ('Tweeter','Whatsapp','Instagram','Facebook'))
        ];
    }
}
