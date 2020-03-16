<?php

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

Route::namespace('API')->group(function () {
    Route::post('login', 'UserController@login')->name('user.login');
    Route::post('register', 'UserController@register')->name('user.register');
    Route::post('logout', 'UserController@logout')->name('user.logout');

    Route::middleware('auth:airlock')->group(function () {
        Route::prefix('urls')->group(function () {
            Route::get('/', 'UrlController@index')->name('urls.index');
            Route::post('/', 'UrlController@store')->name('urls.store');
            Route::get('{url}', 'UrlController@show')->name('urls.show');
            Route::patch('{url}', 'UrlController@update')->name('urls.update');
            Route::delete('{url}', 'UrlController@destory')->name('urls.destory');
        });
    });
});
