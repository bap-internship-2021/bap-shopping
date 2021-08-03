<?php

namespace App\Http\Requests\User\Comment;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\User\Comments\CheckCommentID;

class CreateCommentRequest extends FormRequest
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
            'parent_comment_id' => ['required', 'numeric', new CheckCommentID()],
            'content' => ['required']
        ];
    }
    public function messages()
    {
        return [
            'parent_comment_id.required' => 'Nội dung không được bỏ trống',
            'parent_comment_id.numeric' => 'Yêu cầu không hợp lệ',
            'content.required' => 'Nội dung không được bỏ trống'
        ];
    }
}
