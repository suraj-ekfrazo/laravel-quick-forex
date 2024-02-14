<?php

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

Route::prefix('admin-login')->group(function() {
    Route::get('/', 'AuthController@index')->name('admin-login.index');;
    Route::post('/login', 'AuthController@authenticate')->name('admin-login.login');
    Route::get('/logout', 'AuthController@logout')->name('admin-login.logout');
    Route::get('/home','AuthController@index')->name('home')->middleware('auth.adminLogin');
});
