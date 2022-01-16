<?php

use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//get
Route::get('/get-car-brands', [\App\Http\Controllers\OfferController::class, 'getCarBrands']);
Route::get('/get-make-with-models/{id}', [\App\Http\Controllers\OfferController::class, 'getBrandWithModels']);
Route::get('/get-all-car-extras', [\App\Http\Controllers\OfferController::class, 'getCarExtras']);
Route::get('/get-all-images-from-cdn', [\App\Http\Controllers\ImageKitController::class, 'index']);

//post
Route::post('/image/test', [\App\Http\Controllers\OfferController::class, 'setDataApi']);
