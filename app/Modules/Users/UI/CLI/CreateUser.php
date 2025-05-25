<?php

namespace App\Modules\Users\UI\CLI;

use App\Modules\Users\Data\Models\User;
use Illuminate\Console\Command;

class CreateUser extends Command
{
    protected $signature = 'user:create
                            {name : Имя пользователя}
                            {email : Email}
                            {password : Пароль}
                            {--admin : Сделать админом}';
    protected $description = 'Create new user';

    public function handle(): void
    {
        $name     = $this->argument('name');
        $email    = $this->argument('email');
        $password = $this->argument('password');
        $is_admin = (bool)$this->option('admin');
        if (User::where('email', $email)->exists()) {
            $this->error('такой email уже существует');
        }

        $user = User::create([
            'name'     => $name,
            'email'    => $email,
            'password' => $password,
            'is_admin' => $is_admin,
        ]);
        $this->info(sprintf(
            'Пользователь создан. ID: %d',
            $user->id
        ));
    }
}
