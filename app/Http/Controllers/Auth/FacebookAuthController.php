<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class FacebookAuthController extends Controller
{
    /**
     * Redirect the user to the Facebook authentication page.
     */
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Obtain the user information from Facebook.
     */
    public function handleFacebookCallback()
    {
        try {
            $facebookUser = Socialite::driver('facebook')->user();
            
            // Check if user already exists by email
            $user = User::where('email', $facebookUser->getEmail())->first();
            
            if ($user) {
                // User exists, update login method and log them in
                $user->login_method = 'facebook';
                $user->save();
                Auth::login($user);
            } else {
                // Create new user from Facebook account
                $name = $facebookUser->getName();
                $nameParts = explode(' ', $name, 2);
                $firstName = $nameParts[0] ?? '';
                $lastName = $nameParts[1] ?? '';
                
                // Generate username from email or name
                $email = $facebookUser->getEmail();
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
                    'phone' => '', // Facebook doesn't provide phone by default
                    'password' => bcrypt(Str::random(16)), // Random password since we won't use it
                    'address' => '', // Can be updated later
                    'status' => 1,
                    'login_method' => 'facebook',
                ]);
                
                Auth::login($user);
            }
            
            return redirect()->intended('/');
            
        } catch (\Exception $e) {
            return redirect()->route('login')->with('error', 'Unable to login with Facebook. Please try again.');
        }
    }
}

