<?php

namespace App\Modules\Posts\Data\Pipelines\Post;

use App\Kernel\Contracts\FilterContract;
use Closure;
use Illuminate\Database\Eloquent\Builder;

class SelectFields implements FilterContract
{
    public function handle(Builder $query, Closure $next): Builder
    {
        $fields = request()->input('fields');
        if ($fields) {
            $fieldsArray = array_filter(explode(',', $fields));
            $query->select($fieldsArray);
        }
        return $next($query);
    }
}
