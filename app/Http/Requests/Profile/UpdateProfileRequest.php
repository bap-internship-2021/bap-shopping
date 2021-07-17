<?php

namespace App\Http\Requests\Profile;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'age' => 'required',
            'phone' => 'required|numeric|min:11',
            'address'=> 'required',
            'gender' => 'required',
            'profile_photo_path' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048'
        ];
    }
}
