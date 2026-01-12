<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class ForgotPasswordController extends Controller
{
    public function showLinkRequestForm()
    {
        return view('auth.forgot-password');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'We could not find a user with that email address.']);
        }

        // Generate reset code (6 digits)
        $resetCode = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);
        
        // Store reset code in database (hash it for security)
        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $user->email],
            [
                'token' => password_hash($resetCode, PASSWORD_BCRYPT),
                'created_at' => Carbon::now()
            ]
        );

        // Send email with reset code
        try {
            $resetLink = route('password.reset', ['token' => $resetCode, 'email' => $user->email]);
            
            Mail::send('emails.password-reset', [
                'user' => $user,
                'resetCode' => $resetCode,
                'resetLink' => $resetLink
            ], function ($message) use ($user) {
                $message->to($user->email)
                        ->subject('Password Reset Code - Food Delivery System');
            });

            return back()->with('status', 'We have emailed your password reset code!');
        } catch (\Exception $e) {
            return back()->withErrors(['email' => 'Failed to send email. Please try again later.']);
        }
    }
}
