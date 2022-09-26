<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiAuthController;

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


Route::middleware('auth:sanctum')->post('/v1/logout', [ApiAuthController::class, 'logout'])->name('api_logout');
Route::middleware(['guest'])->post('/v1/login', [ApiAuthController::class, 'login'])->name('api_login');


Route::group(["as" => "api.book.", "prefix" => "v1/books"], function () {
   
    Route::get(
        '/list',
        [
            'as' => 'index',
            'uses' => 'App\Http\Controllers\APIController@index'
        ]
    );

    Route::get(
        '/{id}',
        [
            'as' => 'details',
            'uses' => 'App\Http\Controllers\APIController@show'
        ]
    );

    Route::middleware('auth:sanctum')->post(
        '/update',
        [
            'as' => 'index',
            'uses' => 'App\Http\Controllers\APIController@update'
        ]
    );

    Route::middleware('auth:sanctum')->delete(
        '/{id}',
        [
            'as' => 'delete',
            'uses' => 'App\Http\Controllers\APIController@destroy'
        ]
    );

});



