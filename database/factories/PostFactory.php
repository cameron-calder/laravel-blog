<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    public $thumbnails = [
        'thumbnails/default-2.jpg',
        'thumbnails/default-3.jpg',
        'thumbnails/default-4.jpg',
        'thumbnails/default-5.jpg',
        'thumbnails/default-6.jpg',
    ];

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => $this->faker->text(50),
            'content' => $this->faker->text(),
            'thumbnail_path' => collect($this->thumbnails)
                ->random(),
        ];
    }
}
