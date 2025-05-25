<?php

namespace App\Modules\Users\Actions;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Auth;

class DestroyUserTokenAction
{
    public function __construct(
        private readonly GetAuthUserAction $getAuthUserAction
    ) {
    }

    /**
     * @throws AuthorizationException
     */
    public function run(): bool
    {
        $user = $this->getAuthUserAction->run();

        if ($user) {
            return $user->currentAccessToken()->delete()
                ?? throw new AuthorizationException('User is not authenticated.', 401);
        } else {
            throw new AuthorizationException('User is not authenticated.', 401);
        }

    }
}
