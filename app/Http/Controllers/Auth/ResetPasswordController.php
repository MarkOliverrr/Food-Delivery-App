<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class ResetPasswordController extends Controller
{
    public function showResetForm(Request $request, $token = null, $email = null)
    {
        return view('auth.reset-password', [
            'token' => $token,
            'email' => $email ?? $request->email
        ]);
    }

    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'User not found.']);
        }

        // Check if reset token exists and is valid
        $resetRecord = DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->first();

        if (!$resetRecord) {
            return back()->withErrors(['token' => 'Invalid or expired reset code.']);
        }

        // Check if token matches (compare the plain code with hashed token)
        $tokenMatches = false;
        $plainCode = $request->token;
        
        // Verify the 6-digit code
        if (strlen($plainCode) === 6 && is_numeric($plainCode)) {
            // Try password_verify first (for bcrypt)
            if (password_verify($plainCode, $resetRecord->token)) {
                $tokenMatches = true;
            }
            // Fallback to Hash::check
            elseif (Hash::check($plainCode, $resetRecord->token)) {
                $tokenMatches = true;
            }
        }

        if (!$tokenMatches) {
            return back()->withErrors(['token' => 'Invalid reset code.']);
        }

        // Check if token is expired (24 hours)
        $createdAt = Carbon::parse($resetRecord->created_at);
        if ($createdAt->addHours(24)->isPast()) {
            DB::table('password_reset_tokens')->where('email', $request->email)->delete();
            return back()->withErrors(['token' => 'Reset code has expired. Please request a new one.']);
        }

        // Update password
        $user->password = $request->password; // Model mutator will hash it
        $user->save();

        // Delete reset token
        DB::table('password_reset_tokens')->where('email', $request->email)->delete();

        return redirect()->route('login')->with('status', 'Your password has been reset! You can now login with your new password.');
    }
}
