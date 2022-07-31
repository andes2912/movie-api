<?php

use Illuminate\Support\Facades\Route;
use Modules\Backend\Http\Controllers\BackendController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('backend')->middleware('auth:sanctum')->group( function(){
  Route::prefix('v1')->group( function(){
    // Movie
    Route::prefix('movie')->group(function() {

      Route::get('',[BackendController::class,'ListMovieService']);
      Route::post('insert',[BackendController::class,'InsertMovieService']);
      Route::put('update',[BackendController::class,'UpdateMovieService']);
    });

    // Series
    Route::prefix('series')->group(function() {
        Route::post('insert',[BackendController::class,'CreateSeriesService']);
    });
  });
});
