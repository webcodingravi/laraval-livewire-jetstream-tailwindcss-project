<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();

            $fullName = $googleUser->getName();
            $nameParts = explode(' ', $fullName, 2);

            $firstName = $nameParts[0] ?? '';
            $lastName = $nameParts[1] ?? '';

            $user = User::where('email', $googleUser->getEmail())->first();

            if (! $user) {
                $avatarPath = null;

                if ($googleUser->getAvatar()) {
                    $imageContents = Http::get($googleUser->getAvatar())->body();
                    $filename = 'avatars/'.Str::slug($firstName.'-'.$lastName).'-'.time().'.jpg';
                    Storage::disk('public')->put($filename, $imageContents);
                    $avatarPath = $filename;
                }

                // Create or update user
                $user = User::create([
                    'first_name' => $firstName,
                    'last_name' => $lastName,
                    'fullname' => $fullName,
                    'email' => $googleUser->getEmail(),
                    'google_id' => $googleUser->getId(),
                    'password' => bcrypt(Str::random(16)),
                    'profile_photo_path' => $avatarPath,
                    'email_verified_at' => now(),
                ]);

            } else {
                // Only update google_id if missing
                if (! $user->google_id) {
                    $user->update([
                        'google_id' => $googleUser->getId(),
                    ]);
                }

            }

            Auth::login($user);

            // Redirect to home/dashboard
            return redirect()->intended(route('home'));

        } catch (\Exception $e) {
            return redirect()->route('login')->with('error', 'Google login failed: '.$e->getMessage());
        }
    }
}
