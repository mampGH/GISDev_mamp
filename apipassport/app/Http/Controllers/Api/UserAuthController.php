<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Auth;
use Hash;
use Illuminate\Http\Request;
use App\Models\User;

class UserAuthController extends Controller
{
    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|max:50',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
            'status' => 'required'
        ]);

        $data['password'] = Hash::make($request->password); 

        $user = User::create($data); 

        //$token = $user->createToken('API_Token')->accessToken;
        return response(['user' => $user]);
    }
    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);

        if (!auth()->attempt($data)) {
            return response(['message' => 'Credenciales incorrectas. Intente de nuevo.'], 402);
        }

        $user = Auth::user();
        $token = auth()->user()->createToken('API_Token')->accessToken;
        return response(['user' => $user, 'token' => $token], 200);
    }   

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response(['message' => 'Usuario finalizó sesión']);
    }
}
