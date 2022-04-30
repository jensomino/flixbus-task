<?php

use App\Constant\Endpoints;
use App\Http\Controllers\TripController;
use Illuminate\Support\Facades\Route;

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

Route::middleware('throttle')->group(function(){
    Route::apiResource(Endpoints::TRIP_API_RESOURCE, TripController::class);
    Route::post(Endpoints::TRIPACTION_RESERVE_POST, Endpoints::TRIPACTION_RESERVE_POST_ACTION)->name('tripaction.reserve');
    Route::post(Endpoints::TRIPACTION_CANCEL_POST, Endpoints::TRIPACTION_CANCEL_POST_ACTION)->name('tripaction.cancel');
});
