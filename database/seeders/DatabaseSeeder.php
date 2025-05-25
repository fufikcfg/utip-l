<?php

namespace Database\Seeders;

use App\Modules\Posts\Data\Models\Category;
use App\Modules\Posts\Data\Models\Post;
use App\Modules\Posts\Data\Models\Tag;
use App\Modules\Users\Data\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Category::factory(20)->create();
        Tag::factory(20)->create();
        User::factory(20)->create();

        Post::factory(20)
            ->create()
            ->each(function ($post) {
                $post->tags()->attach(rand(1, 20));
            });
    }
}
