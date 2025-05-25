<?php

namespace App\Modules\Users\Actions;

use App\Modules\Users\Tasks\UpdateUserAvatarTask;
use Illuminate\Http\Request;

class UpdateUserAvatarAction
{
    public function __construct(
        private UpdateUserAvatarTask $updateUserAvatar
    ) {
    }

    public function run(Request $request)
    {
        $this->updateUserAvatar->run(
            $request->file('avatar')->store('avatars', 'public')
        );
    }
}
