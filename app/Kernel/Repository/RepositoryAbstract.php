<?php

namespace App\Kernel\Repository;

use App\Kernel\Contracts\FilterContract;
use App\Kernel\Contracts\RepositoryContract;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Pipeline\Pipeline;

abstract class RepositoryAbstract implements RepositoryContract
{
    abstract public function model(): string;

    public function baseQueryPipeline(array $modelWith, FilterContract|string ...$through): Builder
    {
        return app(Pipeline::class)
            ->send($this->model()::with($modelWith))
            ->through($through)
            ->thenReturn();
    }

    public function create(array $data): Model
    {
        return $this->model()::create($data);
    }

    public function findById(int $id, string $e = ModelNotFoundException::class): ?Model
    {
        return $this->model()::find($id) ?? throw new $e();
    }
}
