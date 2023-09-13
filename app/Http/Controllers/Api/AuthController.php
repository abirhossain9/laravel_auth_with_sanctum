<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    use HttpResponses;

    public function login(LoginRequest $request){
        $data = $request->only('email', 'password');
        if (!Auth::attempt($data)){
            return $this->error('', 'Wrong Credential', 401);
        }
        $user = User::query()->where('email', $request->email)->first();
        return $this->success([
            'user' => $user,
            'token' => $user->createToken('Api Token Of '.$user->name)->plainTextToken
        ], 'Successfully logged in');
    }

    public function register(StoreUserRequest $request){
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password
        ]);

        return $this->success([
            'user' => $user,
            'token' => $user->createToken('Api token of'.$user->name)->plainTextToken,
        ]);
    }

    public function logout(){

    }
}
