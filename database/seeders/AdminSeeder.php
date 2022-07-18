<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $user = User::create([
        'name'      => 'Administrator',
        'email'     => 'admin@mail.com',
        'password'  => Hash::make(12345678),
        'is_active' => true,
        'role'      => 'Admin'
      ]);

      $token = $user->createToken('auth_token')->plainTextToken;

    }
}
