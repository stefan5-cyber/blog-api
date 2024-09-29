<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\Api\RegisterRequest;
use App\Http\Requests\Api\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


class AuthController extends ApiController
{

    public function login(LoginRequest $request)
    {

        if (Auth::attempt($request->only('email', 'password'))) {

            $user = Auth::user();

            return $this->ok(
                'Authenticated',
                [
                    'token' => $user->createToken(
                        'Api token for ' . $user->email, // name
                        ['*'], // ability - permissions
                        now()->addMonth() // expiration time
                    )->plainTextToken
                ]
            );
        }

        return $this->error('Invalid credentials', 401);
    }

    public function logout()
    {

        Auth::user()->currentAccessToken()->delete();

        return $this->ok('');
    }

    public function register(RegisterRequest $request)
    {

        return $this->ok($request->get('email'));
    }
}
