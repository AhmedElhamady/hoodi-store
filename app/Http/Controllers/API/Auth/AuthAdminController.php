<?php

namespace App\Http\Controllers\API\Auth;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;
use App\Traits\ApiResponse;
use Illuminate\Support\Facades\Auth;

class AuthAdminController extends Controller
{
    use ApiResponse;
    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|string|email|max:255',
            'password' => 'required|string|min:6',
        ]);

        $credentials = $request->only('email', 'password');
        if (! $token = Auth::guard('api_admins')->attempt($credentials)) {
            return $this->notFound(__('main.invalid email or password'));
        }
        $data = [
            'token'       => $token,
            'token_type'  => 'bearer',
            'expires_in'  => Auth::guard('api_admins')->factory()->getTTL() * 60, // Token expiration time in seconds
            'admin'       => Auth::guard('api_admins')->user(), // Return authenticated admin details
        ];

        return $this->success($data, __('main.login successful'));
    }


    public function logout()
    {
        JWTAuth::invalidate(JWTAuth::getToken());
        return $this->success([], __('main.logout successfully'));
    }
}