<?php

namespace App\Http\Requests\User\Profile;

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
            'name' => ['required', 'not_regex:/[0-9]+[@#!%&\([^)]*/'],
            'phone' => ['required', 'regex:/(09|03|07|08|05)+([0-9]{8})\b/'],
            'address' => ['required'],
            'gender' => ['required'],
            'file' => 'nullable|image|mimes:jpeg,png,jpg|max:5000'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Vui lòng nhập tên',
            'name.not_regex' => 'Tên không hợp lệ',
            'phone.required' => 'Vui lòng nhập số điện thoại',
            'phone.regex' => 'Số điện thoại không hợp lệ',
            'address.required' => 'Vui lòng nhập địa chỉ',
            'gender' => 'Vui lòng nhập mật khẩu',
            'file.image' => 'File ảnh không đúng định dạng',
            'file.max' => 'File ảnh không dược quá 5 MB'
        ];
    }
}
