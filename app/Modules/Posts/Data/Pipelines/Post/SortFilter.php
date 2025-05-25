<?php

namespace App\Modules\Posts\Data\Pipelines\Post;

use App\Kernel\Contracts\FilterContract;
use Closure;
use Illuminate\Database\Eloquent\Builder;

class SortFilter implements FilterContract
{
    public function handle(Builder $query, Closure $next): Builder
    {
        $sortField = request('sort_field', 'created_at');
        $sortDirection = request('sort_direction', 'desc');
        $query->orderBy($sortField, $sortDirection);
        return $next($query);
    }
}
