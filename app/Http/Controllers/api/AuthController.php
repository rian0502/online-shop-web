<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{


    public function login(Request $request)
    {
        $credentials = $request->only(['email', 'password']);
        if ($token = JWTAuth::attempt($credentials)) {
            return response()->json([
                'success' => true,
                'data' => [
                    'user' => auth()->user(),
                    'credentials' => [
                        'access_token' => $token,
                        'token_type' => 'bearer',
                        'expires_in' => 3600,
                    ]
                ],
                'message' => 'Login successfully'
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'data' => null,
                'message' => 'Invalid credentials'
            ], 401);
        }
    }

    public function me()
    {
        if (auth()->check()) {
            return response()->json([
                'success' => true,
                'data' => [
                    'user' => auth()->user(),
                ],
                'message' => 'User data'
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'data' => null,
                'message' => 'Unauthenticated'
            ], 404);
        }
    }

    public function logout()
    {
        if (auth()->check()) {
            auth()->logout();
            return response()->json([
                'success' => true,
                'data' => null,
                'message' => 'Logout successfully'
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'data' => null,
                'message' => 'Unauthenticated'
            ], 401);
        }
    }

    public function refresh()
    {
        if (auth()->check()) {
            return response()->json([
                'success' => true,
                'data' => [
                    'user' => auth()->user(),
                    'credentials' => [
                        'access_token' => auth()->refresh(),
                        'token_type' => 'bearer',
                        'expires_in' => 3600,
                    ]
                ],
                'message' => 'Token refreshed successfully'
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'data' => null,
                'message' => 'Unauthenticated'
            ], 401);
        }
    }
}
