<?php

namespace App\Modules\Posts\Data\Pipelines\Post;

use App\Kernel\Contracts\FilterContract;
use Closure;
use Illuminate\Database\Eloquent\Builder;

class ByIdFilter implements FilterContract
{
    public function handle(Builder $query, Closure $next): Builder
    {
        return $next(
            $query->where('id', request()->route('id'))->limit(1)
        );
    }
}
