<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Models\User;
use Illuminate\Support\Facades\Log;
 



class AuthController extends Controller
{
    // Register a new user
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        return response()->json([
            'token' => JWTAuth::fromUser($user)
        ]);
    }

    // Authenticate a user
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'Could not create token'], 500);
        }

        return response()->json(['token' => $token]);
    }

    // Get the authenticated user
    public function me()
    {
        return response()->json(Auth::user());
    }

    // Logout user
    public function logoutxx(Request $request)
{
    $user = $request->user();
    $user->token()->revoke();  // Revoke the current token

    //   Auth::logout();
   // return response()->json(['message' => 'Successfully logged out']);

    return response()->json(['message' => 'Successfully logged out'], 200);
}
public function logout(Request $request)
{
    Log::info('Logout method called');
  
    
    auth()->logout();

    Log::info('User logged out successfully');

    return response()->json(['message' => 'Successfully logged out']);
}


}
