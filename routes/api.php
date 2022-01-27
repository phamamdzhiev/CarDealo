<?php

use Illuminate\Support\Facades\Route;

//Protected routes
Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('/my-listing', function () {
        return 'protected';
    });
});

//User
Route::group(['prefix' => 'user'], function () {
    Route::post('/create', [\App\Http\Controllers\UserController::class, 'store']);
    Route::post('/update/{id}', [\App\Http\Controllers\UserController::class, 'update']);
    Route::get('/auth/fetch', [\App\Http\Controllers\UserController::class, 'isAuthenticated']);
});

//Email
Route::group(['prefix' => 'email'], function () {
    Route::post('/verify', [\App\Http\Controllers\EmailController::class, 'confirmEmail']);
    Route::post('/generate-verification-code', [\App\Http\Controllers\EmailController::class, 'sendEmailConfirmationCode']);
});

//Vehicle
Route::group(['prefix' => 'vehicle'], function () {
    Route::get('/fetch/popular-brands', [\App\Http\Controllers\CarController::class, 'getPopularCarBrandsWithLimit']);
    Route::get('/fetch/brands', [\App\Http\Controllers\CarController::class, 'getCarBrands']);
    Route::get('/fetch/car-models/{id}', [\App\Http\Controllers\CarController::class, 'getBrandWithModels']);
    Route::get('/search/brands', [\App\Http\Controllers\CarController::class, 'searchCarBrands']);
    Route::get('/fetch/extras', [\App\Http\Controllers\CarController::class, 'getCarExtras']);
});

//Offer
Route::group(['prefix' => 'offer'], function () {
    Route::post('/create', [\App\Http\Controllers\OfferController::class, 'store']);
});

//Image
Route::group(['prefix' => 'image'], function () {
    Route::post('/upload', [\App\Http\Controllers\ImageController::class, 'uploadImage']);
});
