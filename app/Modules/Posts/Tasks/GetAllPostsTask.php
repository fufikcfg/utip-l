<?php

namespace App\Modules\Posts\Tasks;

use App\Modules\Posts\Data\Repositories\PostRepository;
use Illuminate\Pagination\LengthAwarePaginator;

class GetAllPostsTask
{
    public function __construct(
        private readonly PostRepository $postRepository
    ) {
    }

    public function run(): LengthAwarePaginator
    {
        return $this->postRepository->getAllPaginationPosts();
    }
}
