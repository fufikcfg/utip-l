<?php

namespace App\Modules\Users\Actions;

use App\Modules\Users\Data\Models\User;
use App\Modules\Users\Tasks\GetAuthUserTask;
use Illuminate\Contracts\Auth\Authenticatable;

class GetAuthUserAction
{
    public function __construct(
        private readonly GetAuthUserTask $getAuthUserTask
    ){
    }

    public function run(): Authenticatable|User|null
    {
        return $this->getAuthUserTask->run();
    }
}
