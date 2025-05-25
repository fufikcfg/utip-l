<?php

namespace App\Modules\Users\Data\Services;

use Illuminate\Support\Facades\Hash;

class PasswordHashService
{
    public function hash(string $password): string
    {
        return Hash::make($password);
    }

    public function hashVerify(string $password, string $hashPassword): bool
    {
        return Hash::check($password, $hashPassword);
    }
}
