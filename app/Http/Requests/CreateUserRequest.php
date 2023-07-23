<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6',
            'manageUsers' => 'boolean',
            'manageCategories' => 'boolean',
            'manageConfigurations' => 'boolean',
            'postPermission' => 'required|array',
        ];
    }
}
