<?php

namespace App\Modules\Users\Data\Repositories;

use App\Kernel\Repository\RepositoryAbstract as Repository;
use App\Modules\Users\Data\Models\User;

class UserRepository extends Repository
{
    public function model(): string
    {
        return User::class;
    }
}
