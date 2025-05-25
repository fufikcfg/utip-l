<?php

namespace App\Modules\Users\UI\API\V1\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthorizationUserResource extends JsonResource
{
    public function __construct($resource,
                                private readonly bool $tokenNeed = false
    ) {
        parent::__construct($resource);
    }

    public function toArray(Request $request)
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            $this->mergeWhen($this->tokenNeed, [
                'token' => $this->token ?? null,
            ]),
        ];
    }
}
