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

//Protected routes
Route::group(['middleware' => 'auth:sanctum'], function() {
    Route::get('/my-listing', function () {
       return 'protected';
    });
});

//get
Route::get('/get-popular-car-brands', [\App\Http\Controllers\CarBrandController::class, 'getPopularCarBrandsWithLimit']);
Route::get('/get-car-brands', [\App\Http\Controllers\CarBrandController::class, 'getCarBrands']);
Route::get('/get-make-with-models/{id}', [\App\Http\Controllers\CarBrandController::class, 'getBrandWithModels']);
Route::get('/get-all-car-extras', [\App\Http\Controllers\OfferController::class, 'getCarExtras']);
Route::get('/livesearch/car-brands', [\App\Http\Controllers\CarBrandController::class, 'searchCarBrands']);
//Route::get('/get-all-images-from-cdn', [\App\Http\Controllers\ImageKitController::class, 'index']);

//post
Route::post('/image/test', [\App\Http\Controllers\ImageController::class, 'uploadImage']);
Route::post('/generate-email-verification-code', [\App\Http\Controllers\EmailController::class, 'sendEmailConfirmationCode']);
Route::post('/verify-email', [\App\Http\Controllers\EmailController::class, 'confirmEmail']);
Route::post('create/offer', [\App\Http\Controllers\OfferController::class, 'createOffer']);
