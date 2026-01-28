<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register(Request $request) {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed'
        ]);

        $user = User::create($request->all());
        $token = $user->createToken('token')->plainTextToken;

        return response()->json(['token' => $token], 201);
    }

    public function login(Request $request) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages(['email' => ['Error en credenciales']]);
        }

        $token = $user->createToken('token')->plainTextToken;
        return response()->json(['token' => $token]);
    }
    
    public function logout(Request $request) {
        $request->user()->tokens()->delete();
        return response()->json(['msg' => 'Sesión cerrada']);
    }
}