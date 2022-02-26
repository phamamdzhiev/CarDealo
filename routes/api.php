<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

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

//Profile
Route::group(['prefix' => 'profile', 'middleware' => 'auth:sanctum'], function () {
    Route::patch('/edit/mobile', [\App\Http\Controllers\ProfileController::class, 'updateMobile']);
    Route::patch('/edit/password', [\App\Http\Controllers\ProfileController::class, 'updatePassword']);
    Route::post('/upload/avatar', [\App\Http\Controllers\ProfileController::class, 'uploadAvatar']);
});

//Email
Route::group(['prefix' => 'email', 'middleware' => 'auth:sanctum'], function () {
    Route::post('/verify', [\App\Http\Controllers\EmailController::class, 'confirmEmail']);
    Route::post('/generate-verification-code', [\App\Http\Controllers\EmailController::class, 'sendEmailConfirmationCode']);
});

//Vehicle
Route::group(['prefix' => 'vehicle/fetch'], function () {
    Route::get('/popular-brands', [\App\Http\Controllers\VehicleController::class, 'getPopularCarBrandsWithLimit']);
    Route::get('/brands', [\App\Http\Controllers\VehicleController::class, 'getCarBrands']);
    Route::get('/car-models/{id}', [\App\Http\Controllers\VehicleController::class, 'getBrandWithModels']);
    Route::get('/search/brands', [\App\Http\Controllers\VehicleController::class, 'searchCarBrands']);
    Route::get('/extras', [\App\Http\Controllers\VehicleController::class, 'getCarExtras']);
    Route::get('/vehicle-types', function () {
        return response()->json(\App\Models\VehicleCategory::all()->toArray());
    });
    Route::get('/vehicle-type/{id}/category', function (int $id) {
        return response()->json(\App\Models\VehicleType::all()
            ->where('category_id', '=', $id)
            ->toArray()
        );
    });
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

//Messages
Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('/chat', [App\Http\Controllers\ChatsController::class, 'index']);
    Route::get('/messages', [App\Http\Controllers\ChatsController::class, 'fetchMessages']);
    Route::post('/messages/{id}', [App\Http\Controllers\ChatsController::class, 'sendMessage']);
});

//Password Request and Password Reset
Route::group(['prefix' => 'password', 'middleware' => 'guest'], function () {
    Route::post('/request', [\App\Http\Controllers\AuthController::class, 'requestNewPassword']);
    Route::post('/reset', [\App\Http\Controllers\AuthController::class, 'resetPassword']);
});

//Merchants
Route::group(['prefix' => 'merchants'], function () {
    Route::get('fetch', [\App\Http\Controllers\MerchantController::class, 'index']);
});

// No controller routes

//Regions
Route::get('fetch/regions', function () {
    $expire = \Carbon\Carbon::now()->addCentury();
    $regions = \Illuminate\Support\Facades\Cache::remember('regions', $expire, function () {
        return \App\Models\Region::all();
    });
    return response()->json(['success' => true, 'data' => $regions]);
});

//Cities
Route::get('fetch/cities/{id}', function ($id) {
    return response()->json([
        'success' => true,
        'data' => \App\Models\City::where('region_id', $id)->whereNull('asCity')->get(),
        'asCity' => \App\Models\City::where('region_id', $id)->where('asCity', 1)->get()
    ]);
});

//Popular regions
Route::get('fetch/popular/regions', function () {
    $expire = \Carbon\Carbon::now()->addCentury();
    $popularRegions = \Illuminate\Support\Facades\Cache::remember('popular_regions', $expire, function () {
        return \App\Models\Region::whereIsPopular(1)->get()->toArray();
    });

    return response()->json([
        'success' => true,
        'data' => $popularRegions,
    ]);
});


