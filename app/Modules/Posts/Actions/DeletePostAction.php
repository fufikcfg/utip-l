<?php

namespace App\Modules\Posts\Actions;

use App\Modules\Posts\Data\Repositories\PostRepository;
use Illuminate\Database\Eloquent\Model;

class DeletePostAction
{
    public function __construct(
        private readonly PostRepository $postRepository
    ) {
    }

    public function run(int $id): void
    {
        $this->postRepository->delete($id);
    }
}
