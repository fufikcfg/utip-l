<?php

namespace App\Modules\Users\Actions;

use App\Modules\Users\Data\Models\User;
use App\Modules\Users\Data\Services\PasswordHashService;
use App\Modules\Users\Tasks\GetUserByEmailTask;
use Exception;

class LoginUserAction
{
    public function __construct(
        private readonly GetUserByEmailTask $getUserByEmailTask,
        private readonly PasswordHashService $passwordHashService
    ) {
    }

    /**
     * @throws Exception
     */
    public function run(array $data): User
    {
        $user = $this->getUserByEmailTask->run($data['email']);
        if($this->passwordHashService->hashVerify($data['password'], $user->password)) {
            $user->token = $user->createToken($user->email)->plainTextToken;
            return $user;
        } else {
            return throw new Exception('Password not verify');
        }
    }
}
