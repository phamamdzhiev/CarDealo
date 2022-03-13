<?php

use App\Http\Controllers\AdvancedSearch;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\MerchantController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VehicleController;
use App\Models\VehicleType;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

//Protected routes
Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::post('offer/create', [OfferController::class, 'store']);
    Route::delete('offer/delete/{id}', [OfferController::class, 'destroy']);
    Route::patch('offer/edit/{uid}', [OfferController::class, 'update']);
    Route::post('/logout', [AuthController::class, 'logout']);
});

//User
Route::group(['prefix' => 'user'], function () {
    Route::post('/create', [UserController::class, 'store']);
    Route::post('/update/{id}', [UserController::class, 'update'])->middleware('auth:sanctum');
    Route::get('/auth/fetch', [UserController::class, 'isAuthenticated']);
});

//Profile
Route::group(['prefix' => 'profile', 'middleware' => 'auth:sanctum'], function () {
    Route::patch('/edit/mobile', [ProfileController::class, 'updateMobile']);
    Route::patch('/edit/password', [ProfileController::class, 'updatePassword']);
    Route::post('/upload/avatar', [ProfileController::class, 'uploadAvatar']);
});

//Email
Route::group(['prefix' => 'email', 'middleware' => 'auth:sanctum'], function () {
    Route::post('/verify', [EmailController::class, 'confirmEmail']);
    Route::post('/generate-verification-code', [EmailController::class, 'sendEmailConfirmationCode']);
});

//Vehicle
Route::group(['prefix' => 'vehicle/fetch'], function () {
    Route::get('/brands/{category}/{popular?}', [VehicleController::class, 'getBrands']);
    Route::get('/vehicle/{brand}/category/{category}', [VehicleController::class, 'getBrandWithModels']);
    Route::get('/search/brands', [VehicleController::class, 'searchCarBrands']);
    Route::get('/extras/category/{category}', [VehicleController::class, 'getCarExtras']);
    Route::get('/engines', [VehicleController::class, 'getEngines']);
    Route::get('/vehicle-types', function () {
        return response()->json(\App\Models\VehicleCategory::all()->toArray());
    });
    Route::get('/vehicle-type/{id}/category', function (int $id) {
        return response()->json(VehicleType::where('category_id', '=', $id)->get()->toArray());
    });
});

//Advanced search
Route::get('/fetch/offers', [AdvancedSearch::class, 'fetchOffers']);
Route::get('/fetch/offer/{uid}', [OfferController::class, 'showSingle']);

//Client Auth
Route::group(['prefix' => 'auth'], function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
});

//Image
Route::group(['prefix' => 'image', 'middleware' => 'auth:sanctum'], function () {
    Route::post('/upload', [ImageController::class, 'uploadImage']);
});

//CarDealo used offers/cars
Route::group(['prefix' => 'offers'], function () {
    Route::get('/fetch/recommended', [OfferController::class, 'show']);
    Route::get('/fetch/user/listing', [OfferController::class, 'userListing'])
        ->middleware('auth:sanctum');
});

//Messages
Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('/chat', [App\Http\Controllers\ChatsController::class, 'index']);
    Route::get('/messages', [App\Http\Controllers\ChatsController::class, 'fetchMessages']);
    Route::post('/messages/{id}', [App\Http\Controllers\ChatsController::class, 'sendMessage']);
});

//Password Request and Password Reset
Route::group(['prefix' => 'password', 'middleware' => 'guest'], function () {
    Route::post('/request', [AuthController::class, 'requestNewPassword']);
    Route::post('/reset', [AuthController::class, 'resetPassword']);
});

//Merchants
Route::group(['prefix' => 'merchants'], function () {
    Route::get('fetch', [MerchantController::class, 'index']);
});


//Regions
Route::get('fetch/regions', [RegionController::class, 'get']);

//Cities
Route::get('fetch/cities/{id}', [RegionController::class, 'getCitiesInRegion']);

//Popular regions
Route::get('fetch/popular/regions', [RegionController::class, 'popular']);

Route::get('fetch/colors', [ColorController::class, 'get']);

Route::group(['prefix' => 'fetch'], function () {
    Route::get('category', [CategoryController::class, 'get']);
});

