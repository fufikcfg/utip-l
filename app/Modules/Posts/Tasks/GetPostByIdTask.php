<?php

namespace App\Modules\Posts\Tasks;

use App\Modules\Posts\Data\Repositories\PostRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class GetPostByIdTask
{
    public function __construct(
        private PostRepository $postRepository
    ) {
    }

    public function run(): Collection
    {
        return $this->postRepository->getById()->get();
    }
}
