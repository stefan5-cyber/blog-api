<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\Api\LoginRequest;
use Illuminate\Support\Facades\Auth;
use App\Permissions\V1\Abilities;


class AuthController extends ApiController
{

    /**
     * Login
     * 
     * Authenticates the user and returns the user's API Token.
     * 
     * @group Authentication
     * @response 200{
    "data": {
        "token": "{YOUR_AUTH_TOKEN}"
    },
    "message": "Authenticated",
    "status": 200
    }
     */
    public function login(LoginRequest $request)
    {

        if (Auth::attempt($request->only('email', 'password'))) {

            $user = Auth::user();

            return $this->ok(
                'Authenticated',
                [
                    'token' => $user->createToken(
                        'Api token for ' . $user->email, // name
                        Abilities::getAbilities($user), // ability - permissions
                        now()->addMonth() // expiration time
                    )->plainTextToken
                ]
            );
        }

        return $this->error('Invalid credentials', 401);
    }

    /**
     * Logout
     * 
     * Sings out the user and destroy's the API token.
     * 
     * @authenticated
     * @group Authentication
     * @response 200 {}
     */
    public function logout()
    {

        Auth::user()->currentAccessToken()->delete();

        return $this->ok('');
    }
}
