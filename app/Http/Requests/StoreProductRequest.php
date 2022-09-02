<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|unique:products|string|max:255|min:3',
            'price' => 'required|numeric',
            'description' => 'required',
            'category' => 'required|string|max:255|min:3',
            'image' => 'nullable|url|max:255|min:3',
        ];
    }
}
