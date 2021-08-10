<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Profile\UpdateProfileRequest;

class ProfileController extends Controller
{
    //
    public function index(){
        return view('admin.profile.index');
    }

    public function handleUpdateProfile(UpdateProfileRequest $request ) {
        $data = $request->except(['_method', '_token', 'file']);
        $user = User::find(Auth::id());

            if ($request->hasFile('file')) {
                dd('ok');
                $image = $request->file('file');
                $imageName = time() . $image->getClientOriginalName();
                $data['profile_photo_path'] = $imageName;
                dd($data);
                if($image->move('admin/images/avatar', $imageName)){
                    File::delete(public_path('admin/images/avatar/' . auth()->user()->profile_photo_path)); // delete current profile image
                    $user->update($data);
                    return back()->with('status', 'Cập nhật thành công');
                }
            } else{
                $user->update($data);
                return back()->with('status', 'Cập nhật thông tin cá nhân thành công!');
            }

        return back()->with('update-fail', 'Vui lòng thử lại!')->withInput();
    }
}
