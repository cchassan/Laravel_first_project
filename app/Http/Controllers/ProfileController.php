<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index(){
        return view('profile/profile');
    }

    public function updateProfile($id, Request $request)
    {
        $user = User::find($id);
        $request->validate(
            [
                'name' => ['required', 'string', 'max:255'],
                'phone' => ['numeric', 'min:10', 'nullable'],
                'address' => ['string', 'max:255', 'nullable'],
                'user_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]
        );

        if ($request->hasFile('user_image')) {
            $image = $request->file('user_image');
            $extension = $image->getClientOriginalExtension();
            $baseName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
            $name = $baseName . '_' . $id . '.' . $extension;
            $destinationPath = public_path('/uploads/users');

            // Check if file already exists
            if (!file_exists($destinationPath . '/' . $name)) {
                $image->move($destinationPath, $name);
                $user->user_image = '/uploads/users/' . $name;
            } else {
                $user->user_image = '/uploads/users/' . $name;
            }
        }

        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->update();

        $message = array(
            'message' => "Profile Updated Successfully.",
            'type' => "success",
        );

        return redirect()->route('profile')->with($message);
    }


    public function updatePassword($id , Request $request){
        $user = User::find($id);
        $request->validate([
            'oldPassword' => ['required', function ($attribute, $value, $fail) use ($user) {
                if (!\Hash::check($value, $user->password)) {
                    return $fail(__('The current password is incorrect.'));
                }
            }],
            'newPassword' => 'required|min:4',
            'password_confirmation'=> 'required|same:newPassword',
        ]);

        $user->password = Hash::make($request->newPassword);
        $user->update();
        $message = array(
            'message' => "Save Done.",
            'type'=> "success",
        );
        return redirect()->route('profile')->with($message);
    }


}
