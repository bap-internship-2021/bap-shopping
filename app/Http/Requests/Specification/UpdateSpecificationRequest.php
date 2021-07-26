<?php

namespace App\Http\Requests\Specification;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSpecificationRequest extends FormRequest
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
            'screen' => 'required|string|max:255',
            'camera' => 'required|string|max:255',
            'camera_selfie' => 'required|string|max:255',
            'ram' => 'required|string|max:255',
            'internal_memory' => 'required|string|max:255',
            'cpu' => 'required|string|max:255',
            'gpu' => 'required|string|max:255',
            'pin' => 'required|string|max:255',
            'sim' => 'required|string|max:255',
            'operating_system' => 'required|string|max:255',
            'made_in' => 'required|string|max:255',
            'release_time' => 'required|date_format:Y-m-d',
            'description' => 'required',
        ];
    }
}
