<?php

namespace App\Modules\Users\UI\API\V1\Controllers;

use App\Kernel\Http\Controllers\Controller;
use App\Modules\Users\Actions\DestroyUserTokenAction;
use App\Modules\Users\Actions\GetAuthUserAction;
use App\Modules\Users\Actions\LoginUserAction;
use App\Modules\Users\Actions\RegistrationUserAction;
use App\Modules\Users\Actions\UpdateUserAvatarAction;
use App\Modules\Users\UI\API\V1\Requests\UserAvatarRequest;
use App\Modules\Users\UI\API\V1\Requests\UserCreateRequest;
use App\Modules\Users\UI\API\V1\Requests\UserLoginRequest;
use App\Modules\Users\UI\API\V1\Resources\AuthorizationUserResource;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Psr\Log\InvalidArgumentException;

class AuthorizationUserController extends Controller
{
    public function __construct(
        readonly private RegistrationUserAction $registrationUserAction,
        readonly private GetAuthUserAction      $getAuthUserAction,
        readonly private DestroyUserTokenAction $destroyUserToken,
        readonly private LoginUserAction        $loginUserAction,
        readonly private UpdateUserAvatarAction $updateUserAvatarAction,
    ) {
    }

    public function registration(UserCreateRequest $request): AuthorizationUserResource
    {
        return new AuthorizationUserResource($this->registrationUserAction->run(
            $request->validated()
        ), true);
    }

    public function verify(): AuthorizationUserResource
    {
        return new AuthorizationUserResource(
            $this->getAuthUserAction->run()
        );
    }

    /**
     * @throws Exception
     */
    public function login(UserLoginRequest $request): AuthorizationUserResource
    {
        return new AuthorizationUserResource(
            $this->loginUserAction->run(
                $request->validated()
            ), true);
    }

    /**
     * @throws AuthorizationException
     */
    public function exit(): JsonResponse
    {
        if ($this->destroyUserToken->run()) {
            return new JsonResponse(status: 201);
        } else {
            throw new InvalidArgumentException(status: 500);
        }
    }

    public function avatar(UserAvatarRequest $request): JsonResponse
    {
        $this->updateUserAvatarAction->run($request);
        return new JsonResponse(status: 201);
    }
}
