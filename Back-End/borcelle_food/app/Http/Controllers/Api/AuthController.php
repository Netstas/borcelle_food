<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function adminLogin(LoginRequest $request)
    {
        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            $user = User::where('username', $request->username)->first();
            if ($user->role === 1) {
                $user->remember_token = $user->createToken('token')->plainTextToken;
                return response()->json(['user' => $user, 'message' => 'đăng nhập thành công!'], 200);
            } else {
                return response()->json(['errors' => 'bạn không có quyền truy cập!'], 403);
            }
        }
        return response()->json(['errors' => 'sai tên đăng nhập hoặc mật khẩu!'], 401);
    }

    public function login(LoginRequest $request)
    {
        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            $user = User::where('username', $request->username)->first();
            $user->remember_token = $user->createToken('token')->plainTextToken;
            return response()->json(['user' => $user, 'message' => 'đăng nhập thành công!'], 200);
        }
        return response()->json(['errors' => 'sai tên đăng nhập hoặc mật khẩu!'], 401);
    }

    public function register(RegisterRequest $request)
    {
        $user = User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password)
        ]);
        return response()->json(['user' => $user, 'message' => 'đăng kí tài khoản thành công!'], 201);
    }

    public function userInfo(Request $request)
    {
        return response()->json(Auth::user(), 200);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json(['message' => 'đăng xuất thành công!'], 200);
    }
}