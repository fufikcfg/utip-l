<?php

namespace App\Modules\Posts\Actions;

use App\Modules\Posts\Data\Repositories\PostRepository;

class UpdatePostAction
{
    public function __construct(
        private readonly PostRepository $postRepository
    ) {
    }

    public function run(int $id, array $data): bool
    {
        return $this->postRepository->updatePost($id, $data);
    }
}
