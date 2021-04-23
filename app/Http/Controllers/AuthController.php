<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $datos = $request->validate([
            "email" => "required|string|email",
            "password" => "required|string"
        ]);

        $user = User::where("email", $request->email)->first();

        if(!$user || !Hash::check($request->password, $user->password)){
            return response()->json([
                "mensaje" => "Error de Auth"
            ], 401);
        }

        $token = $user->createToken('myapptoken')->plainTextToken;

        return response()->json([
            "user" => $user,
            "token" => $token
        ], 200);
    }

    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();
        return [
            "mensaje" => "Salió"
        ];
    }
}
