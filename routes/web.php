<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('admin/login', [App\Http\Controllers\Admin\AuthController::class, 'index'])
    ->name('admin.login.index')->middleware('guest:admin');

Route::post('admin/login', [App\Http\Controllers\Admin\AuthController::class, 'login'])
    ->name('admin.login');

Route::group(['prefix' => 'admin', 'middleware' => 'auth.admin'], function () {
    Route::get('/index', [App\Http\Controllers\Admin\IndexController::class, 'index'])->name('admin.index');
    Route::get('/listings', [App\Http\Controllers\Admin\ListingController::class, 'index'])->name('admin.listings');
    Route::get('/users', [App\Http\Controllers\Admin\UserController::class, 'index'])->name('admin.users');
    Route::get('/logout', [App\Http\Controllers\Admin\AuthController::class, 'logout'])->name('admin.logout');
});
//Route::get('/hash', function () {
//    return Hash::make('pedal');
//});
Route::get('/{any}', function () {
    return view('welcome');
})->where('any', '.*');



