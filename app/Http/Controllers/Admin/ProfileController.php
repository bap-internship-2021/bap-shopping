<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Profile\UpdateProfileRequest;

class ProfileController extends Controller
{
    //
    public function index(){
        return view('admin.profile.index');
    }

    public function handleUpdateProfile(UpdateProfileRequest $request ) {
        $userid = Auth::id();
        $user = User::findOrFail($userid);

        $data = $request->except(['_method', '_token']);

        $image = $request->file('file');

        if ($image) {
            $imageName = time() . $image->getClientOriginalName();
            
            $data['profile_photo_path'] = $imageName;
        }

        if($user->update($data)){
            if($image){
                
                $image->move('admin/images/avatar', $imageName);
                
            }
            return back()->with('status', 'update success');
        } else {
            return back()->with('status', 'update error');
        }
    }
}
