<?php

namespace App\Kernel\Contracts;

use Closure;
use Illuminate\Database\Eloquent\Builder;

interface FilterContract
{
    public function handle(Builder $query, Closure $next): Builder;
}
