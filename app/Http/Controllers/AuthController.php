<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{   
    public function register(Request $request){
        
        $validator = Validator::make($request->all(), [
        'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        // Crear el usuario
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = JWTAuth::fromUser($user);

        return response()->json([
            'message' => 'Usuario registrado con éxito',
            'user' => $user,
            'token' => $token
        ], 201);
    }
    


    public function login(Request $request)
{
    $credentials = $request->only('email', 'password');

    if (Auth::guard('api')->attempt($credentials)) {
        $user = Auth::guard('api')->user();
        $jwt = JWTAuth::attempt($credentials);
        return response()->json([
            'success' => true,
            'data' => [
                'user' => $user,
                'jwt' => $jwt,
            ],
        ]);
    } else {
        return response()->json([
            'success' => false,
            'message' => 'Credenciales incorrectas',
        ], 401);
    }
}
    public function logout(){
        Auth::guard('api')->logout();
        $success = true;
        return compact('success');
    }
}
