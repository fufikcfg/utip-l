<?php

namespace Database\Factories;

use App\Modules\Posts\Data\Models\Category;
use App\Modules\Posts\Data\Models\Post;
use App\Modules\Users\Data\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    protected $model = Post::class;

    public function definition(): array
    {
        return [
            'title' => fake()->sentence(),
            'content' => fake()->paragraph(4),
            'category_id' => Category::factory(),
            'user_id' => User::factory(),
        ];
    }
}
