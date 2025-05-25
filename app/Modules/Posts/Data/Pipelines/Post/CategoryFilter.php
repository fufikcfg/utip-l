<?php

namespace App\Modules\Posts\Data\Pipelines\Post;

use App\Kernel\Contracts\FilterContract;
use Closure;
use Illuminate\Database\Eloquent\Builder;

class CategoryFilter implements FilterContract
{
    public function handle(Builder $query, Closure $next): Builder
    {
        if (request()->filled('category_id')) {
            $query->where('category_id', request('category_id'));
        }
        return $next($query);
    }
}
