<?php

namespace App\Http\Controllers\User\Profile;

use App\Http\Controllers\Controller;
use App\Models\User;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests\User\Profile\UpdateProfileRequest;

class ProfileController extends Controller
{
    public function show()
    {
        $user = User::where('id', Auth::id())->get();
        if (!$user) {
            return route('/');
        }

        return view('users.profiles.show');
    }

    public function update(UpdateProfileRequest $request)
    {
        $data = $request->except(['_method', '_token', 'file']);
        $user = User::find(Auth::id());


            if ($request->hasFile('file')) {
                $image = $request->file('file');
                $imageName = time() . $image->getClientOriginalName();
                $data['profile_photo_path'] = $imageName;
                if($image->move('admin/images/avatar', $imageName)){
                    $user->update($data);
                    return back()->with('update-success', 'Cập nhật thành công');
                }
            } else{
                $user->update($data);
                return back()->with('update-success', 'Cập nhật thành công');
            }

        return back()->with('update-fail', 'Vui lòng thử lại!')->withInput();
    }
}
