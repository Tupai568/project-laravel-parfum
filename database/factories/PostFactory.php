<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'judul' => $this->faker->sentence(mt_rand(1, 2)),
            'descripsi' => $this->faker->sentence(mt_rand(1, 10)),
            'harga' => '12000',
            'category_id' => mt_rand(1, 3),
            'status_id' => mt_rand(1, 2)
        ];
    }
}
