<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function index(Request $request)
    {
        return view('backend.pages.profile.profile');
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'fName' => 'required|string|max:255',
            'lName' => 'nullable|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'required|string|max:15|unique:users,phone,' . $user->id,
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $user->fname = $request->fName;
        $user->lname = $request->lName;
        $user->phone = $request->phone;
        $user->email = $request->email;

        if ($request->hasFile('image')) {
            $path = public_path('backend/images/users/');
            if ($user->image && file_exists($path . $user->image)) {
                unlink($path . $user->image);
            }

            $imageName = time() . '.' . $request->image->extension();
            $request->image->move($path, $imageName);
            $user->image = $imageName;
        }

        $user->save();
        toast('Profile updated successfully!', 'success');
        return redirect()->back();
    }

    public function reset(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Current password does not match']);
        }

        $user->update([
            'password' => Hash::make($request->password)
        ]);

        toast('Password updated successfully!', 'success');
        return redirect()->back();
    }
}
