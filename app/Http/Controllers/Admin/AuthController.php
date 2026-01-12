<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        $admin = Admin::where('username', $credentials['username'])
            ->orWhere('email', $credentials['username'])
            ->first();

        if ($admin) {
            $password = $credentials['password'];
            $stored = $admin->password;

            if (Hash::check($password, $stored)) {
                Auth::guard('admin')->login($admin);
                $request->session()->regenerate();
                return redirect()->route('admin.dashboard');
            }

            if (md5($password) === $stored) {
                // upgrade to bcrypt via model mutator
                $admin->password = $password;
                $admin->save();

                Auth::guard('admin')->login($admin);
                $request->session()->regenerate();
                return redirect()->route('admin.dashboard');
            }
        }

        return back()->withErrors([
            'username' => 'Invalid username or password.',
        ])->onlyInput('username');
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login');
    }
}

