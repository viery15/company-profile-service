<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePostRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'categoryId' => 'required|integer|max:255',
            'content' => 'required|string',
            'thumbnail' => 'required|string',
            'catalog' => 'string',
            'catalogDescription' => 'string',
        ];
    }
}
