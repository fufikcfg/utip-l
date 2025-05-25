<?php

namespace App\Modules\Posts\UI\API\V1\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title'       => 'string|max:255',
            'content'     => 'string',
            'category_id' => 'integer|exists:categories,id',
            'tags'        => 'nullable|array',
            'tags.*'      => 'integer|exists:tags,id',
        ];
    }
}
