<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApiAuthController extends Controller
{
    //
    public function login(Request $request)
    {
        $request->validate([
            "email" => "required|email",
            "password" => "required|min:8",
        ]);

        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                "message" => "email or password wrong"
            ]);
        }

        $token = $request->user()->createToken('window');
        return response()->json([
            "message" => "login successfully",
            "device_name" => $token->accessToken->name,
            "token" => $token->plainTextToken
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json([
            "message" => "logout successfully"
        ]);
    }

    public function logoutAll(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json([
            "message" => "logout successfully from all devices"
        ]);
    }

    public function devices(Request $request)
    {
        return $request->user()->tokens;
    }
}
