<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public int $userCount = 15;
    public int $userPostsCount = 5;
    public int $commentsCount = 75;

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory($this->userCount)
            ->create()
            ->each(function (User $user) {
                $posts = Post::factory($this->userPostsCount)
                    ->make();

                $user->posts()
                    ->saveMany($posts);
           });

        Comment::factory($this->commentsCount)
            ->create();
    }
}
