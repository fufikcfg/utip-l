<?php

namespace App\Modules\Posts\Data\Pipelines\Post;

use App\Kernel\Contracts\FilterContract;
use Closure;
use Illuminate\Database\Eloquent\Builder;

class UserFilter implements FilterContract
{
    public function handle(Builder $query, Closure $next): Builder
    {
        if (request()->filled('user_id')) {
            $query->where('user_id', request('user_id'));
        }
        return $next($query);
    }
}
