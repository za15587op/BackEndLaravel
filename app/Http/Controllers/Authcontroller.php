<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class Authcontroller extends Controller
{
    public function register(Request $request)
    {
        $fileds = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|confirmed',
            'adress' => 'required|string',
            'telephone' => 'required|string',
            'role' => 'required|integer',
        ]);

        $user = User::create([
            'name' => $fileds['name'],
            'email' => $fileds['email'],
            'password' => bcrypt($fileds['password']),
            'adress' => $fileds['adress'],
            'telephone' => $fileds['telephone'],
            'role' => $fileds['role'],
        ]);
        $token = $user->createToken($request->userAgent(), [$fileds['role']])->plainTextToken;

        $reponse = [
            'user' => $user,
            'token' => $token,
        ];
        return response($reponse, 201);
    }

    public function login(Request $request)
    {

        $fields = $request->validate([
            'name' => 'required|string',
            'password' => 'required|string',
        ]);

        // Check email
        $user = User::where('name', $fields['name'])->first();

        if (!$user || !Hash::check($fields['password'], $user->password)) {
            return response([
                'message' => 'Invalid Login',
            ], 401);
        } else {

            // ลบ Token เก่าออกก่อน แล้วค่อยสร้างใหม่
            $user->tokens()->delete();
            $token = $user->createToken($request->userAgent(), ["$user->role"])->plainTextToken;
            $response = [
                'user' => $user,
                'token' => $token,
            ];

            return response($response, 200);
        }
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        // auth()->user()->tokens()->delete();
        return response([
            'message' => 'Logged Out',
        ], 200);
    }
}
