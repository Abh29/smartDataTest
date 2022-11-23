<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers;

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
    return redirect(route('author.index'));
});


Auth::routes(['register' => false, 'login' => false]);
Route::get('/admin', 'App\Http\Controllers\Auth\LoginController@showLoginForm')->name('login');
Route::post('/admin', 'App\Http\Controllers\Auth\LoginController@login');
Route::get('/home', function() {
    return redirect(route('admin.author.index'));
});


Route::group(["as" => "book.", "prefix" => "books"], function () {
   
    Route::get(
        '/',
        [
            'as' => 'index',
            'uses' => 'App\Http\Controllers\BookController@index'
        ]
    );

    Route::get(
        '/{id}',
        [
            'as' => 'details',
            'uses' => 'App\Http\Controllers\BookController@show'
        ]
    );
});


Route::group(["as" => "author.", "prefix" => "authors"], function () {
   
    Route::get(
        '/',
        [
            'as' => 'index',
            'uses' => 'App\Http\Controllers\AuthorController@index'
        ]
    );

    Route::get(
        '/{id}',
        [
            'as' => 'details',
            'uses' => 'App\Http\Controllers\AuthorController@show'
        ]
    );
});


Route::group(["as" => "admin.", "prefix" => "admin", "middleware" => "auth"], function () {
      
    Route::group(["as" => "author.", "prefix" => "authors"], function () {
    
        Route::get(
            '/',
            [
                'as' => 'index',
                'uses' => 'App\Http\Controllers\HomeController@authors'
            ]
        );

        Route::get(
            '/edit/{id}',
            [
                'as' => 'edit',
                'uses' => 'App\Http\Controllers\AuthorController@edit',
            ]
        );

        Route::get(
            '/create',
            [
                'as' => 'create',
                'uses' => 'App\Http\Controllers\AuthorController@create',
            ]
        );

        Route::post(
            '/',
            [
                'as' => 'store',
                'uses' => 'App\Http\Controllers\AuthorController@store',
            ]    
        );

        Route::patch(
            '/{id}',
            [
                'as' => 'update',
                'uses' => 'App\Http\Controllers\AuthorController@update',
            ]
            );
        Route::delete(
            '/{id}',
            [
                'as' => 'delete',
                'uses' => 'App\Http\Controllers\AuthorController@destroy',
            ]
            );
    });


    Route::group(["as" => "book.", "prefix" => "books"], function () {
    
        Route::get(
            '/',
            [
                'as' => 'index',
                'uses' => 'App\Http\Controllers\HomeController@books'
            ]
        );

        Route::get(
            '/edit/{id}',
            [
                'as' => 'edit',
                'uses' => 'App\Http\Controllers\BookController@edit',
            ]
        );

        Route::get(
            '/create',
            [
                'as' => 'create',
                'uses' => 'App\Http\Controllers\BookController@create',
            ]
        );

        Route::post(
            '/',
            [
                'as' => 'store',
                'uses' => 'App\Http\Controllers\BookController@store',
            ]    
        );

        Route::patch(
            '/{id}',
            [
                'as' => 'update',
                'uses' => 'App\Http\Controllers\BookController@update',
            ]
            );

        Route::delete(
            '/{id}',
            [
                'as' => 'delete',
                'uses' => 'App\Http\Controllers\BookController@destroy',
            ]
            );
    });

});




