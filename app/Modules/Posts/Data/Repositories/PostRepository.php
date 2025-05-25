<?php

namespace App\Modules\Posts\Data\Repositories;

use App\Kernel\Repository\RepositoryAbstract;
use App\Modules\Posts\Data\Exceptions\ForbiddenException;
use App\Modules\Posts\Data\Models\Post;
use App\Modules\Posts\Data\Pipelines\Post\ByIdFilter;
use App\Modules\Posts\Data\Pipelines\Post\CategoryFilter;
use App\Modules\Posts\Data\Pipelines\Post\SelectFields;
use App\Modules\Posts\Data\Pipelines\Post\SortFilter;
use App\Modules\Posts\Data\Pipelines\Post\TagFilter;
use App\Modules\Posts\Data\Pipelines\Post\UserFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\UnauthorizedException;

class PostRepository extends RepositoryAbstract
{
    public function model(): string
    {
        return Post::class;
    }

    public function getAllPaginationPosts(): LengthAwarePaginator
    {
        $allowedExpands = ['category', 'user', 'tags'];
        $expand = request()->query('expand', '');
        $modelWith = array_filter(
            explode(',', $expand),
            fn($relation) => in_array($relation, $allowedExpands)
        );

        $query = $this->baseQueryPipeline($modelWith,
            SelectFields::class, CategoryFilter::class, UserFilter::class, TagFilter::class, SortFilter::class
        );

        return $query->paginate();
    }

    public function getById(): Builder
    {
        $allowedExpands = ['category', 'user', 'tags'];
        $expand = request()->query('expand', '');
        $modelWith = array_filter(
            explode(',', $expand),
            fn($relation) => in_array($relation, $allowedExpands)
        );

        return $this->baseQueryPipeline($modelWith,
            SelectFields::class, SortFilter::class, ByIdFilter::class
        );
    }

    public function createPost(array $data): Model
    {
        $data['user_id'] = Auth::id() ?? throw new UnauthorizedException('Unauthorized', 401);
        $post = $this->create($data);
        if (!empty($data['tags'])) {
            $post->tags()->sync($data['tags']);
        }

        return $post;
    }

    public function updatePost(int $id, array $data): bool
    {
        $post = $this->findById($id);
        if ($post->user_id == Auth::id()) {
            $post->update($data);
            if (!empty($data['tags'])) {
                $post->tags()->sync($data['tags']);
            }
        } else {
            throw new ForbiddenException('Forbidden', 403);
        }

        return !empty($post);
    }

    public function delete(int $id): void
    {
        $post = $this->findById($id);
        if ($post->user_id == Auth::id())
        {
            $post->delete();
        } else {
            throw new ForbiddenException('Forbidden', 403);
        }
    }
}
