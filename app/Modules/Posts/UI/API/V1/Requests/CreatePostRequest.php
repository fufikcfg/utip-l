<?php

namespace App\Modules\Posts\UI\API\V1\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePostRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title'       => 'required|string|max:255',
            'content'     => 'required|string',
            'category_id' => 'required|integer|exists:categories,id',
            'tags'        => 'nullable|array',
            'tags.*'      => 'integer|exists:tags,id',
        ];
    }
}
