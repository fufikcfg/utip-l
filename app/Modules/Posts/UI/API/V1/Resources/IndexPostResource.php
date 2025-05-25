<?php

namespace App\Modules\Posts\UI\API\V1\Resources;

use App\Modules\Users\UI\API\V1\Resources\AuthorizationUserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class IndexPostResource extends JsonResource
{
    // Отказано, т.к. ?expand=category, ?fields=id,name
    public function toArray($request): array
    {
        return [
            'id'         => $this->id,
            'title'      => $this->title,
            'content'    => $this->content,
            'category_id'=> $this->category_id,
            'user_id'    => $this->user_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'category'   => new CategoryResource($this->whenLoaded('category')),
            'user'       => new AuthorizationUserResource($this->whenLoaded('user')),
            'tags'       => TagResource::collection($this->whenLoaded('tags')),
        ];
    }
}

