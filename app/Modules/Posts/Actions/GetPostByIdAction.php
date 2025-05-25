<?php

namespace App\Modules\Posts\Actions;

use App\Modules\Posts\Tasks\GetPostByIdTask;
use Illuminate\Database\Eloquent\Collection;

class GetPostByIdAction
{
    public function __construct(
        private GetPostByIdTask $getPostByIdTask
    ) {
    }

    public function run(): Collection
    {
        return $this->getPostByIdTask->run();
    }
}

