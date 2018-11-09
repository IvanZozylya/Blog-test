<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;


class UserController extends Controller
{
    public function profile()
    {
        return view('profile', [
            'user' => Auth::user(),
        ]);
    }

    public function update_avatar(Request $request)
    {

        // Handle the user upload of avatar
        if ($request->hasFile('avatar')) {

            $this->validate($request, [
                'avatar' => 'required|image|mimes:jpeg,png,jpg,giv,svg|max:2048',
            ]);

            //verify validation
            if ($request->file('avatar')->isValid()) {

                //save new avatar
                $avatar = $request->file('avatar');
                $filename = time() . '.' . $avatar->getClientOriginalExtension();
                Image::make($avatar)->resize(300, 300)->save(public_path('images/uploads/avatars/' . $filename));
                $user = Auth::user();
                $user->avatar = $filename;
                $user->save();
            }
        }
        return view('profile', array('user' => Auth::user()));

    }
}
