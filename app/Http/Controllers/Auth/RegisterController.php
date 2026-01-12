<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => ['required', 'string', 'max:255', 'unique:users,username'],
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'phone' => ['required', 'string', 'min:10'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'address' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        try {
            $user = User::create([
                'username' => $request->username,
                'f_name' => $request->firstname,
                'l_name' => $request->lastname,
                'email' => $request->email,
                'phone' => $request->phone,
                // Let User model mutator hash the password
                'password' => $request->password,
                'address' => $request->address,
                'status' => 1,
            ]);
        } catch (\Throwable $e) {
            return back()->with('error', 'Registration failed. Please check your inputs and try again.')->withInput();
        }

        auth()->login($user);

        return redirect()->route('home');
    }
}

