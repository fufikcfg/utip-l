<?php

namespace App\Modules\Posts\UI\API\V1\Resources;

use App\Modules\Users\UI\API\V1\Resources\AuthorizationUserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'         => $this->id,
            'name'       => $this->name,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
