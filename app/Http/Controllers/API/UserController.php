<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginUserRequest;
use App\Eloquent\User;
use App\Http\Requests\RegisterUserRequest;
use App\Http\Resources\UserResource;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function login(LoginUserRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return ['message' => 'Successful login.'];
        }

        return response(['message' => 'User not found.'], Response::HTTP_UNAUTHORIZED);
    }

    public function logout()
    {
        Auth::logout();
        return ['message' => 'Successful logout.'];
    }

    public function register(RegisterUserRequest $request)
    {
        return [
            'message' => 'Successfully registered.',
            'user' => new UserResource(User::create($request->all()))
        ];
    }
}
