<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'post_id' => Post::select('id')
                ->inRandomOrder()
                ->first()
                ->id,
            'content' => $this->faker->paragraph(rand(1, 5)),
            'created_by' => User::select('id')
                ->inRandomOrder()
                ->first()
                ->id,
        ];
    }
}
