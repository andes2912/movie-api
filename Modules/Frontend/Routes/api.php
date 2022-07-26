<?php

use Illuminate\Support\Facades\Route;
use Modules\Frontend\Http\Controllers\FrontendController;

Route::prefix('v1')->group(function(){
    Route::get('discover',[FrontendController::class,'DiscoverService']);
    Route::get('latest',[FrontendController::class,'LatestService']);
    Route::get('/',[FrontendController::class,'DetailService']);
});
