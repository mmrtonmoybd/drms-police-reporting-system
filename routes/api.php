<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API;
use App\Http\Controllers\API_Auth;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['cors'])->group(function () {
    Route::get('/store', [API::class, 'StoreContext']);
    Route::post('/contact', [API::class, 'AddContact']);
    Route::get('/singledakbanglo/{id}', [API::class, 'DakbangloByID']);
    Route::get('/rooms/{id?}', [API::class, 'Rooms']);
    Route::post('/signup', [API_Auth::class, 'SignUp']);
    Route::get('/bookings', [API_Auth::class, 'Bookings']);
    Route::get('/room-details/{room_id?}', [API::class, 'RoomDetails']);

    Route::group(['middleware' => ['jwt.verify']], function () {
        Route::get('/bookings', [API_Auth::class, 'Bookings']);
        Route::post('/booknow', [API_Auth::class, 'BookNow']);
    });

    Route::group([
        'middleware' => 'api',
        'namespace' => 'App\Http\Controllers',
        'prefix' => 'auth'
    ], function ($router) {
        Route::post('/login', [API_Auth::class, 'Login']);
    });
});
