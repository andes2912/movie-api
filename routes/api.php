<?php
use Illuminate\Support\Facades\Route;

/// AUTH \\\
  // login
  Route::post('register',[App\Http\Controllers\API\AuthController::class, 'register']);
  // Register
  Route::post('/login', [App\Http\Controllers\API\AuthController::class, 'login']);


Route::group(['middleware' => ['auth:sanctum']], function () {
  Route::prefix('v1')->group( function (){
    // Logout
    Route::post('/logout', [App\Http\Controllers\API\AuthController::class, 'logout']);
  });
});
