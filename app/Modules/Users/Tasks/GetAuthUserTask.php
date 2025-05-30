<?php

namespace App\Modules\Users\Tasks;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Auth;

class GetAuthUserTask
{
    public function run(): ?Authenticatable
    {
        return Auth::user();
    }
}
