<?php

namespace App\Modules\Posts\Actions;

use App\Modules\Posts\Tasks\GetAllPostsTask;
use Illuminate\Pagination\LengthAwarePaginator;

class GetAllPostsAction
{
    public function __construct(
        private readonly GetAllPostsTask $getAllPostsTask
    ){
    }

    public function run(): LengthAwarePaginator
    {
        return $this->getAllPostsTask->run();
    }
}
