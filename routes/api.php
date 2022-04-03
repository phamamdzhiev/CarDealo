<?php

use App\Http\Controllers\AdvancedSearch;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\FuelController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\MerchantController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\TransmissionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VehicleController;
use App\Models\VehicleType;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

//Protected routes
Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::post('offer/create', [OfferController::class, 'store'])->name('offer.create');
    Route::delete('offer/delete/{id}', [OfferController::class, 'destroy'])->name('offer.delete');
    Route::patch('offer/edit/{uid}', [OfferController::class, 'update'])->name('offer.edit');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

//User
Route::group(['prefix' => 'user'], function () {
    Route::post('/create', [UserController::class, 'store'])->name('user.create');
    Route::post('/update/{id}', [UserController::class, 'update'])->middleware('auth:sanctum')->name('user.edit');
    Route::get('/auth/fetch', [UserController::class, 'isAuthenticated'])->name('get.auth.user');
});

//Profile
Route::group(['prefix' => 'profile', 'middleware' => 'auth:sanctum'], function () {
    Route::patch('/edit/mobile', [ProfileController::class, 'updateMobile'])->name('edit.mobile');
    Route::patch('/edit/password', [ProfileController::class, 'updatePassword'])->name('edit.password');
    Route::post('/upload/avatar', [ProfileController::class, 'uploadAvatar'])->name('upload.avatar');
    Route::post('/upload/description', [ProfileController::class, 'updateDescription'])->name('upload.description');
});

//Email
Route::group(['prefix' => 'email', 'middleware' => 'auth:sanctum'], function () {
    Route::post('/verify', [EmailController::class, 'confirmEmail']);
    Route::post('/generate-verification-code', [EmailController::class, 'sendEmailConfirmationCode']);
});

//Vehicle
Route::group(['prefix' => 'vehicle/fetch'], function () {
    Route::get('/brands/{category}/{popular?}', [VehicleController::class, 'getBrands'])->name('get.brands');
    Route::get('/vehicle/{brand}/category/{category}', [VehicleController::class, 'getBrandWithModels'])->name('get.brand.models');
    Route::get('/search/brands/{vehicleTypeID}', [VehicleController::class, 'searchCarBrands'])->name('live.search.brands');
    Route::get('/extras/category/{category}', [VehicleController::class, 'getCarExtras'])->name('get.extras');
    Route::get('/engines', [VehicleController::class, 'getEngines'])->name('get.engines');
    Route::get('/vehicle-type/{id}/category/{popular?}', [CategoryController::class, 'getTypes'])->name('get.types');
});

//Advanced search
Route::get('/fetch/offers', [AdvancedSearch::class, 'fetchOffers'])->name('get.offers');
Route::get('/fetch/offer/{uid}', [OfferController::class, 'showSingle'])->name('get.offer');

//Client Auth
Route::group(['prefix' => 'auth'], function () {
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/register', [AuthController::class, 'register'])->name('register');
});

//Image
Route::group(['prefix' => 'image', 'middleware' => 'auth:sanctum'], function () {
    Route::post('/upload', [ImageController::class, 'uploadImage'])->name('image.upload');
});

//CarDealo used offers/cars
Route::group(['prefix' => 'offers'], function () {
    Route::get('/fetch/recommended', [OfferController::class, 'show']);
    Route::get('/fetch/user/listing', [OfferController::class, 'userListing'])
        ->middleware('auth:sanctum');
});

//Messages
//Route::group(['middleware' => 'auth:sanctum'], function () {
//    Route::get('/chat', [App\Http\Controllers\ChatsController::class, 'index']);
//    Route::get('/messages', [App\Http\Controllers\ChatsController::class, 'fetchMessages']);
//    Route::post('/messages/{id}', [App\Http\Controllers\ChatsController::class, 'sendMessage']);
//});

//Password Request and Password Reset
Route::group(['prefix' => 'password', 'middleware' => 'guest'], function () {
    Route::post('/request', [AuthController::class, 'requestNewPassword'])->name('password.request');
    Route::post('/reset', [AuthController::class, 'resetPassword'])->name('password.reset');
});

//Merchants
Route::group(['prefix' => 'merchants'], function () {
    Route::get('fetch', [MerchantController::class, 'index'])->name('get.merchants');
    Route::get('fetch/single/{id}', [MerchantController::class, 'show'])->name('get.merchant');
    Route::get('fetch/auth/merchant', [MerchantController::class, 'getAuthMerchant'])->name('get.auth.merchant');
});

Route::group(['prefix' => 'fetch'], function () {
    Route::get('category', [CategoryController::class, 'get'])->name('get.categories');
    Route::get('/regions', [RegionController::class, 'get'])->name('get.regions');
    //Popular regions
    Route::get('/popular/regions', [RegionController::class, 'popular'])->name('get.regions.popular');
    //Cities
    Route::get('/cities/{id}', [RegionController::class, 'getCitiesInRegion'])->name('get.region.cities');
    //Colors
    Route::get('/colors', [ColorController::class, 'get'])->name('get.colors');
    //Fuels
    Route::get('/fuels', [FuelController::class, 'get'])->name('get.fuels');
    //Transmissions
    Route::get('/transmissions', [TransmissionController::class, 'get'])->name('get.transmissions');
});

Route::post('send/contact/message', [\App\Http\Controllers\ContactController::class, 'store'])->name('send.message');
Route::post('send/fraud/message', [\App\Http\Controllers\FraudController::class, 'store'])->name('send.fraud.message');
