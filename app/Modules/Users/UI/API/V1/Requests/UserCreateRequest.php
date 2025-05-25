<?php

namespace App\Modules\Users\UI\API\V1\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserCreateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:25',
            'email' => 'required|email|unique:users',
            'password' => 'required|string',
        ];
    }
}
