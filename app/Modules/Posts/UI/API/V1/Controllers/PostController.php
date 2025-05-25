<?php

namespace App\Modules\Posts\UI\API\V1\Controllers;

use App\Kernel\Http\Controllers\Controller;
use App\Modules\Posts\Actions\CreatePostAction;
use App\Modules\Posts\Actions\DeletePostAction;
use App\Modules\Posts\Actions\GetAllPostsAction;
use App\Modules\Posts\Actions\GetPostByIdAction;
use App\Modules\Posts\Actions\UpdatePostAction;
use App\Modules\Posts\UI\API\V1\Requests\CreatePostRequest;
use App\Modules\Posts\UI\API\V1\Requests\UpdatePostRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use InvalidArgumentException;

class PostController extends Controller
{
    public function __construct(
        private readonly GetAllPostsAction $getAllPosts,
        private readonly GetPostByIdAction $getPostById,
        private readonly CreatePostAction $createPostAction,
        private readonly UpdatePostAction $updatePostAction,
        private readonly DeletePostAction $deletePostAction,
    ) {
    }

    public function index(): JsonResource
    {
        return JsonResource::collection($this->getAllPosts->run());
    }

    public function show(): JsonResource
    {
        return JsonResource::collection($this->getPostById->run());
    }

    public function store(CreatePostRequest $request): JsonResource
    {
        return JsonResource::make($this->createPostAction->run($request->validated()));
    }

    public function update(int $id, UpdatePostRequest $request): JsonResponse
    {
        if ($this->updatePostAction->run($id, $request->validated())) {
            return new JsonResponse(status: 201);
        } else {
            throw new InvalidArgumentException(status: 500);
        }
    }

    public function destroy(int $id): JsonResponse
    {
        $this->deletePostAction->run($id);
        return new JsonResponse();
    }
}
