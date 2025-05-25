<?php

namespace App\Kernel\Providers;

use App\Kernel\PathConfigFiles\Migrations\PathConfigMigrationFiles;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->loadMigrationsFrom((new PathConfigMigrationFiles())->handle());
    }
}
