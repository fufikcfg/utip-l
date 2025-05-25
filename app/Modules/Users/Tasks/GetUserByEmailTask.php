<?php

namespace App\Modules\Users\Tasks;

use App\Modules\Users\Data\Models\User;
use Exception;

class GetUserByEmailTask
{
    /**
     * @throws Exception
     */
    public function run(string $email): ?User
    {
        return User::where('email', $email)->first()
            ?? throw new Exception('User not found');
    }
}
