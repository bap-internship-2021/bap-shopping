<?php

namespace App\Http\Requests\product;

use Illuminate\Foundation\Http\FormRequest;

class CreateProductRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            //
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:1',
            'quantity' => 'required|numeric|min:1',
            'category_id' => 'required',
            'files' => 'required|array|min:4',
            'files.*' => 'file|mimes:jpeg,jpg,png,gif,jfif',
        ];
    }
}