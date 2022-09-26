<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class ApiAuthController extends Controller
{
        public function login(Request $request)
        {
            $data = $request->validate([
                'email' => 'required|email',
                'password' => 'required'
            ]);

            $user = User::where('email', $data['email'])->first();
            if (! $user || ! Hash::check($data['password'], $user->password))
                return Response([
                    'error' => 'Wrong email or password'
                ], 401);
        
            $app_key = env('APP_KEY', 'some_application_key');
            $token = $user->createToken($app_key)->plainTextToken;

            return Response([
                'user' => $user,
                'token' => $token
            ]);
        }

        public function logout(Request $request)
        {
            auth()->user()->tokens()->delete();
            return [
                'massage' => 'logged out'
            ];
        }
}
