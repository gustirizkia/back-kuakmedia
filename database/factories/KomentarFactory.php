<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Komentar>
 */
class KomentarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'body' => $this->faker->paragraph($nbSentences = 3, $variableNbSentences = true),
            'article_id' => $this->faker->numberBetween($min = 1, $max = 30),
            'user_id' => $this->faker->numberBetween($min = 1, $max = 20),
        ];
    }
}
