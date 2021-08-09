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
            'files' => 'required|array|min:3|max:6',
            'files.*' => 'file|mimes:jpeg,jpg,png,gif,jfif',
            'screen' => 'nullable|string|max:255',
            'camera' => 'nullable|string|max:255',
            'camera_selfie' => 'nullable|string|max:255',
            'ram' => 'nullable|string|max:255',
            'internal_memory' => 'nullable|string|max:255',
            'cpu' => 'nullable|string|max:255',
            'gpu' => 'nullable|string|max:255',
            'pin' => 'nullable|string|max:255',
            'sim' => 'nullable|string|max:255',
            'operating_system' => 'nullable|string|max:255',
            'made_in' => 'nullable|string|max:255',
            'release_time' => 'nullable|date_format:Y-m-d',
            'description' => 'nullable',
        ];
    }
}
