<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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

        $title = fake()->words(3, true);

        return [

            'user_id' => User::factory(),
            'title' => $title,
            'slug' => Str::slug($title),
            'status' => fake()->randomElement(['A', 'D', 'X']), 
            'content' => fake()->paragraph()

        ];
    }
}
