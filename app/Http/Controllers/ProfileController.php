<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\User;


class ProfileController extends Controller
{

    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }


    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    public function updateavatar(Request $request)
{
    $request->validate([
        'img' => 'required|image|mimes:jpeg,png,jpg,gif|max:5048',
    ]);

    $user = Auth::user();

    if ($request->hasFile('img')) {
        $imageName = time() . '.' . $request->file('img')->extension(); 
        $request->file('img')->move(public_path('avatars'), $imageName); 
        $imgPath = 'public/avatars/' . $imageName; 

        $user->avatar = $imgPath;
        $user->save();

        return redirect()->back()->with('success', 'Avatar updated successfully.');
    } else {
        return redirect()->back()->with('error', 'No avatar image provided.');
    }
}


    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }


    
    

}


