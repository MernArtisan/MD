<?php

namespace App\Http\Controllers\api;

use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();


        if (! $user || ! Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Invalid credentials.'
            ], 401);
        }

        $token = $user->createToken('api-token')->plainTextToken;
        $userData = $user->toArray();
        $userData['image'] = asset('storage/', $user->image);

        return response()->json([
            'message' => 'Login successful.',
            'token'   => $token,
            'data'    => [
                'user' => $user
            ]
        ]);
    }

    public function profile(Request $request)
    {

        if (! $request->user()) {
            return response()->json([
                'error' => 'Unauthenticated. Please provide a valid token.'
            ], 401);
        }

        $validated = $request->validate([
            'image' => 'nullable|mimes:jpeg,jpg,png',
            'name' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'country' => 'nullable|string|max:100',
            'bio' => 'nullable|string|max:500',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = $image->getClientOriginalName();
            $image->move(public_path('/img'), $imageName);

            $validated['image'] = 'img/' . $imageName;
        }

        $user = $request->user();
        $user->update($validated);


        return response()->json([
            'message' => 'Profile updated successfully',
            'user' => $user,
        ], 200);
    }

    public function forgotPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'User not found with this email.'
            ], 404);
        }

        // Generate OTP
        $otp = rand(1000, 9999);

        DB::table('password_reset_tokens')->updateOrInsert([
            'email' => $request->email
        ], [
            'token' => $otp,
            'created_at' => now(),
        ]);

        Mail::raw("Your OTP for password reset is: $otp", function ($message) use ($request) {
            $message->to($request->email)
                ->subject('Password Reset OTP');
        });

        return response()->json([
            'status' => true,
            'message' => 'OTP sent to your registered email.',
            'email' => $request->email,
            'otp' => $otp,
        ], 200);
    }


    public function verifyOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp' => 'required|string',
        ]);

        $otpCheck = DB::table('password_reset_tokens')->where([
            'email' => $request->email,
            'token' => $request->otp,
        ])->first();
        if (!$otpCheck) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid OTP'
            ], 401);
        }
        return response()->json([
            'status' => true,
            'message' => 'OTP verified successfully!',
        ], 200);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return response()->json([
                'status' => false,
                'error' => 'User not found with this email.'
            ]);
        }

        $user->update([
            'password' => bcrypt($request->password),
        ]);

        DB::table('password_reset_tokens')->where('email', $request->email)->delete();
        return response()->json([
            'status' => true,
            'message' => 'Password reset successfully!',
        ], 200);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json([
            'status' => 200,
            'message' => 'User logged out successfully!'
        ]);
    }
}
