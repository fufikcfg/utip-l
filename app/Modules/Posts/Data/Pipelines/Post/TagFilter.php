<?php

namespace App\Modules\Posts\Data\Pipelines\Post;

use App\Kernel\Contracts\FilterContract;
use Closure;
use Illuminate\Database\Eloquent\Builder;

class TagFilter implements FilterContract
{
    public function handle(Builder $query, Closure $next): Builder
    {
        if (request()->filled('tag_id')) {
            $tagId = request('tag_id');
            $query->whereHas('tags', function ($q) use ($tagId) {
                $q->where('tags.id', $tagId);
            });
        }
        return $next($query);
    }
}
