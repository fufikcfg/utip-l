<?php

namespace App\Modules\Users\Tasks;

use App\Modules\Users\Data\Repositories\UserRepository;
use App\Modules\Users\Data\Services\PasswordHashService;
use Illuminate\Database\Eloquent\Model as User;

class CreateUserTask
{
    public function __construct(
        readonly private UserRepository $userRepository,
        readonly private PasswordHashService $passwordHashService
    ) {
    }
    public function run(array $data): User
    {
        return $this->userRepository->create(
            $this->hashPasswordInData($data)
        );
    }

    private function hashPasswordInData(array $data): array
    {
        $data['password'] = $this->passwordHashService->hash($data['password']);

        return $data;
    }
}
