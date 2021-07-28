<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\User\UpdateNewPasswordRequest;
use GrahamCampbell\ResultType\Success;

class UserController extends Controller
{
    public function userChangeNewPassword(UpdateNewPasswordRequest $request)
    {
        $user = User::find(Auth::id());
        $newPassword = bcrypt($request->input('new_password'));
        if($user->update(['password' => $newPassword])) {
            return redirect()->route('users.profiles.show')->with(['change-pass-success' => 'Thay đổi mật khẩu thành công']);
        }
        return redirect()->route('users.profiles.show')->with(['change-pass-fail' => 'Có lỗi, vui lòng thử lại']);
    }
}
