<?php

namespace App\Modules\Users\Tasks;

use Illuminate\Support\Facades\Auth;

class UpdateUserAvatarTask
{
    public function run(string $path): void
    {
        Auth::user()->update(['avatar' => $path]);
    }
}
