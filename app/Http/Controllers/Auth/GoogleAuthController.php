<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class GoogleAuthController extends Controller
{
    /**
     * Redirect the user to the Google authentication page.
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from Google.
     */
    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
            
            // Check if user already exists by email
            $user = User::where('email', $googleUser->getEmail())->first();
            
            if ($user) {
                // User exists, update login method and log them in
                $user->login_method = 'google';
                $user->save();
                Auth::login($user);
            } else {
                // Create new user from Google account
                $name = $googleUser->getName();
                $nameParts = explode(' ', $name, 2);
                $firstName = $nameParts[0] ?? '';
                $lastName = $nameParts[1] ?? '';
                
                // Generate username from email or name
                $email = $googleUser->getEmail();
                $username = $email ? explode('@', $email)[0] : strtolower(str_replace(' ', '', $name)) . '_' . rand(1000, 9999);
                
                // Ensure username is unique
                $originalUsername = $username;
                $counter = 1;
                while (User::where('username', $username)->exists()) {
                    $username = $originalUsername . '_' . $counter;
                    $counter++;
                }
                
                $user = User::create([
                    'username' => $username,
                    'f_name' => $firstName,
                    'l_name' => $lastName,
                    'email' => $email,
                    'phone' => '', // Google doesn't provide phone by default
                    'password' => bcrypt(Str::random(16)), // Random password since we won't use it
                    'address' => '', // Can be updated later
                    'status' => 1,
                    'login_method' => 'google',
                ]);
                
                Auth::login($user);
            }
            
            return redirect()->intended('/');
            
        } catch (\Exception $e) {
            return redirect()->route('login')->with('error', 'Unable to login with Google. Please try again.');
        }
    }
}

