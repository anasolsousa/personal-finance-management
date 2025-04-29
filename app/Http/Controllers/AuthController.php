<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Admin;

class AuthController extends Controller
{
     // Login para Admin
    public function loginAdmin(Request $request)
    {
        $credentials = $request->only('email', 'password');
        
        if (!$token = auth('admin')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token, 'admin');
    }

    // Login para User
    public function loginUser(Request $request)
    {
        $credentials = $request->only('email', 'password');
        
        if (!$token = auth('user')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token, 'user');
    }

    // Registro de novo usuário
    public function register(Request $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        $token = auth('user')->login($user);

        return $this->respondWithToken($token, 'user');
    }

    public function userProfile()
    {
        $user = User::all();
        return response()->json($user);
    }

    public function adminProfile()
    {
        $admin = Admin::all();
        return response()->json($admin);
    }

    // Logout
    public function logout()
    {
        auth()->logout();
        return response()->json(['message' => 'Successfully logged out']);
    }


    // Resposta padrão com token
    protected function respondWithToken($token, $guard)
    {
        return response()->json([
            'token' => $token, // nome do token para aceder
            'token_type' => 'bearer',
            'expires_in' => auth($guard)->factory()->getTTL() * 60
        ]);
    }
}
