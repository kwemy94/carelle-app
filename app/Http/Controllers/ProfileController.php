<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ProfileUpdateRequest;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();


        $notification = array(
            'message' => "Profile mise à jour !",
            'alert-type' => 'success'
        );

        return Redirect::route('profile.edit')->with($notification);
    }

    /**
     * Delete the user's account.
     */
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

    public function updateAvatar(Request $request)
    {
        try {
            $user = Auth::user();

            if (!is_null($request->avatar)) {
                $profilImage = $request->file('avatar');
                $profilName = time().'.'.$profilImage->extension();
                #$request->avatar->storeAs('dashboard-template/dist/img', $profilName);
                $request->avatar->move(public_path('images'), $profilName);
                
            }
           
            if (file_exists(public_path('images/'.$user->avatar))) {
                // dd(1);
                unlink(public_path('images/'.$user->avatar));
            }
    
            DB::table('users')
                ->where('id', $user->id)
                ->update(['avatar' => $profilName]);
            
        } catch (\Exception $e) {
            errorManager('Echec mise à jour avatar : ', $e, $e);
            $notification = array(
                'message' => "Echec de mise à jour de la photo",
                'alert-type' => 'error'
            );

            return Redirect::route('profile.edit')->with($notification);
        }

        $notification = array(
            'message' => "Profile mise à jour !",
            'alert-type' => 'success'
        );

        return Redirect::route('profile.edit')->with($notification);
    }
}
