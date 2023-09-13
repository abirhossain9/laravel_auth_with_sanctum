<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    use HttpResponses;

    public function login(){

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
