<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Twilio\Rest\Client;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string|max:13|min:13',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'password' => 'required|string|min:8',
            'type' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $phoneNumber = $request->input('phone');

        $verificationCode = mt_rand(100000, 999999);

        $this->sendVerificationCode($phoneNumber, $verificationCode);

        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->phone = $phoneNumber;
        $user->latitude = $request->input('latitude');
        $user->longitude = $request->input('longitude');
        $user->password = Hash::make($request->input('password'));
        $user->verification_code = $verificationCode;
        $user->type = $request->input('type');

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images/users');
            $user->image = $imagePath;
        }

        $user->save();

        return response()->json(['message' => 'User registered successfully', 'verification_code' => $verificationCode, 'code' => 200], 201);
    }

    private function sendVerificationCode($phoneNumber, $verificationCode)
    {
        $sid = env('TWILIO_SID');
        $token = env('TWILIO_TOKEN');
        $twilioNumber = env('TWILIO_PHONE');

        $twilio = new Client($sid, $token);

        try {
            $message = $twilio->messages->create(
                $phoneNumber,
                [
                    'from' => $twilioNumber,
                    'body' => 'Your verification code is: ' . $verificationCode,
                ]
            );

            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function login()
    {
        $credentials = request(['email', 'password', 'verification_code']);

        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    public function logout()
    {
        Auth::logout();

        return response()->json(['message' => 'Successfully logged out', 'code' => 200]);
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}
