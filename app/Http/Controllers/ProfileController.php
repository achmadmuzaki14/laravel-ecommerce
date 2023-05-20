<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;
use App\Models\User;

class ProfileController extends Controller
{
    public function index($id)
    {
        $profile = Profile::where('user_id', $id)->get();
        $user = \Auth::user();

        $user_profile = [
            $profile,
            $user
        ];

        // dd($user, $profile);
        return view('dashboard.polluxui.partials.profile', compact('user_profile'));
    }

    public function update(Request $request, $id)
    {
        $profile = Profile::find($id);
        $user = User::find($id);

        $profile->update([
            'address' => $request->address,
            'phone' => $request->phone,
            'gender' => $request->gender,
            'dob' => $request->dob,
        ]);
        $profile->save();

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);
        $user->save();

        return redirect()->back()->with('success', 'Profile updated successfully');
    }
}
