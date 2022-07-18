<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Services\AuthServices;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    protected $service;

    public function __construct(AuthServices $service)
    {
      $this->service = $service;
    }


    //REGISTER
    public function register(RegisterRequest $request)
    {
      return $this->service->RegisterService($request);
    }

    // LOGIN
    public function login(LoginRequest $request)
    {
      return $this->service->LoginService($request);
    }

    // method for user logout and delete token
    public function logout()
    {
        auth()->user()->tokens()->delete();

        return [
            'message' => 'You have successfully logged out and the token was successfully deleted'
        ];
    }
}
