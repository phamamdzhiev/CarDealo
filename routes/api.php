<?php

use Illuminate\Support\Facades\Route;

//Protected routes
Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('/my-listing', function () {
        return 'protected';
    });

    Route::post('offer/create', [\App\Http\Controllers\OfferController::class, 'store']);
    Route::delete('offer/delete/{id}', [\App\Http\Controllers\OfferController::class, 'destroy']);
    Route::post('/logout', [\App\Http\Controllers\AuthController::class, 'logout']);
});

//User
Route::group(['prefix' => 'user'], function () {
    Route::post('/create', [\App\Http\Controllers\UserController::class, 'store']);
    Route::post('/update/{id}', [\App\Http\Controllers\UserController::class, 'update'])->middleware('auth:sanctum');
    Route::get('/auth/fetch', [\App\Http\Controllers\UserController::class, 'isAuthenticated']);
});

//Email
Route::group(['prefix' => 'email', 'middleware' => 'auth:sanctum'], function () {
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

//Advanced search
Route::get('/fetch/offers', [\App\Http\Controllers\AdvancedSearch::class, 'fetchOffers']);
Route::get('/fetch/offer/{id}', [\App\Http\Controllers\OfferController::class, 'showSingle']);

//Client Auth
Route::group(['prefix' => 'auth'], function () {
    Route::post('/login', [\App\Http\Controllers\AuthController::class, 'login']);
    Route::post('/register', [\App\Http\Controllers\AuthController::class, 'register']);
});

//Image
Route::group(['prefix' => 'image', 'middleware' => 'auth:sanctum'], function () {
    Route::post('/upload', [\App\Http\Controllers\ImageController::class, 'uploadImage']);
});

//CarDealo used offers/cars
Route::group(['prefix' => 'offers'], function () {
    Route::get('/fetch/recommended', [\App\Http\Controllers\OfferController::class, 'show']);
    Route::get('/fetch/user/listing', [\App\Http\Controllers\OfferController::class, 'userListing'])
        ->middleware('auth:sanctum');
});
