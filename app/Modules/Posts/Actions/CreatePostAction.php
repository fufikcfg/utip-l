<?php

namespace App\Modules\Posts\Actions;

use App\Modules\Posts\Data\Repositories\PostRepository;
use Illuminate\Database\Eloquent\Model;

class CreatePostAction
{
    public function __construct(
        private readonly PostRepository $postRepository
    ) {
    }

    public function run(array $data): Model
    {
        return $this->postRepository->createPost($data);
    }
}
