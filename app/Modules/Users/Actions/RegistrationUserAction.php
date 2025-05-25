<?php

namespace App\Modules\Users\Actions;

use App\Modules\Users\Tasks\CreateUserTask;
use Illuminate\Database\Eloquent\Model as User;

class RegistrationUserAction
{
    public function __construct(
      readonly private CreateUserTask $createUserTask
    ) {
    }

    public function run(array $data): User
    {
        $user = $this->createUserTask->run($data);
        $user->token = $user->createToken($data['email'])->plainTextToken;
        return $user;
    }
}
