<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class SocialAuthController extends Controller
{
    public function redirect() {
        return Socialite::driver('google')->redirect();
    }

    public function callback() {
 try {
    $googleUser = Socialite::driver('google')->stateless()->user();


     $fullName = $googleUser->getName();
     $nameParts = explode(' ',$fullName,2);

     $firstName = $nameParts[0] ?? '';
     $lastName = $nameParts[1] ?? '';

          // Download profile image
        $avatarPath = null;
        if ($googleUser->getAvatar()) {
            $imageContents = Http::get($googleUser->getAvatar())->body();
            $filename = 'avatars/' . Str::slug($firstName . '-' . $lastName) . '-' . time() . '.jpg';
            Storage::disk('public')->put($filename, $imageContents);
            $avatarPath = $filename;
        }


     $user = User::where('email',$googleUser->getEmail())->first();
     if(!$user) {
        $user->update([
            'google_id' => $googleUser->getId(),
        ]);
     }else{

          $user = User::updateOrCreate(
          [
            'first_name' => $firstName,
            'last_name' => $lastName,
            'fullname' => $fullName,
            'email' => $googleUser->getEmail(),
            'google_id' => $googleUser->getId(),
            'password' => Hash::make(Str::random(16)),
            'profile_photo_path' => $avatarPath,
            'email_verified_at' => now()
          ]
     );


     // Login the user
        Auth::login($user);

        // Redirect to intended / home page
        return redirect()->intended(route('home'));

     }



 } catch (\Exception $e) {
            // Error catch karo, browser me show karo
            return redirect()->route('login')->with('error', 'Google login failed: ' . $e->getMessage());
        }
    }


}
