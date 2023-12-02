<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('api')->except(['login']);
    }

    public function login(Request $request)
    {
        $credentials = $request->only(['email', 'password']);
        if ($token = JWTAuth::attempt($credentials)) {
            return response()->json([
                'success' => true,
                'data' => [
                    'user' =>  auth()->guard('api')->user(),
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
        if (Auth::guard('api')->check()) {
            return response()->json([
                'success' => true,
                'data' => [
                    'user' => auth()->guard('api')->user(),
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
        if (Auth::guard('api')->check()) {
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
        if (Auth::guard('api')->check()) {
            return response()->json([
                'success' => true,
                'data' => [
                    'user' =>  auth()->guard('api')->user(),
                    'credentials' => [
                        'access_token' => auth()->guard('api')->refresh(),
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
