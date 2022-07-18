<?php

namespace App\Services;

use App\Helpers\ClientResponderHelper;
use App\Models\User;
use ErrorException;
use Illuminate\Support\Facades\Hash;

class AuthServices {

  use ClientResponderHelper;

  // Register
  public function RegisterService($params)
  {
    try {
        $user = User::create([
          'name' => $params->name,
          'email' => $params->email,
          'password' => Hash::make($params->password)
        ]);

      $token = $user->createToken('auth_token')->plainTextToken;
      $result = collect($user)->merge(['token'=>$token]);
      return $this->responseSuccess(200, 'Login Success.', $result);

    } catch (\ErrorException $e) {
      return $this->responseFailed($e->getMessage());
    }
  }

  // Login
  public function LoginService($params)
  {
    try {
      $email = $params->email;
      $user = User::where('email', $email)->first();
      if (!$user) return $this->responseFailed("User Tidak Terdaftar!");

      if (auth()->attempt([
        'email'     => $params->email,
        'password'  => $params->password
        ])) {

        $token = $user->createToken('auth_token')->plainTextToken;

        $result = collect($user)->merge(['token'=>$token]);
        return $this->responseSuccess(200, 'Login Success.', $result);
      }else{
        throw new ErrorException("Username atau Password Salah!");
      }

    } catch (\ErrorException $e) {
      return $this->responseFailed($e->getMessage());
    }
  }
}