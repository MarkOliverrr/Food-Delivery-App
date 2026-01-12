<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        // Allow username OR email in the same field
        $user = User::where('username', $credentials['username'])
            ->orWhere('email', $credentials['username'])
            ->first();

        if ($user) {
            $password = $credentials['password'];
            $stored = $user->password;

            // 1) Try bcrypt/hash check
            if (Hash::check($password, $stored)) {
                Auth::login($user);
                $request->session()->regenerate();
                return redirect()->intended('/');
            }

            // 2) Fallback: legacy md5 password -> on success, upgrade to bcrypt
            if (md5($password) === $stored) {
                // Upgrade hash for next time
                $user->password = $password; // model mutator will Hash::make
                $user->save();

                Auth::login($user);
                $request->session()->regenerate();
                return redirect()->intended('/');
            }
        }

        return back()->withErrors([
            'username' => 'Invalid username or password.',
        ])->onlyInput('username');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}

