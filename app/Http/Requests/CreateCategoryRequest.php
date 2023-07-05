<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCategoryRequest extends FormRequest
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
            'seq' => 'integer|max:255',
            'pinToMenu' => 'boolean',
            'showPosts' => 'boolean',
            'thumbnail' => 'string'
        ];
    }
}
