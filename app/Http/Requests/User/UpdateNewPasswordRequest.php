<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\User\CheckPassword;

class UpdateNewPasswordRequest extends FormRequest
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
            'old_password' => ['required', new CheckPassword()],
            'new_password' => ['required', 'confirmed', 'min:6', 'max:33']
        ];
    }

    public function messages()
    {
        return [
            'old_password.required' => 'Vui lòng nhập mật khẩu cũ',
            'new_password.required' => 'Vui lòng nhập mật khẩu mới',
            'new_password.confirmed' => 'Vui lòng nhập lại mật khẩu mới',
            'new_password.min' => 'Mật khẩu mới phải ít nhất 6 ký tự',
            'new_password.max' => 'Mật khẩu mới không được quá 32 ký tự'
        ];
    }
}
