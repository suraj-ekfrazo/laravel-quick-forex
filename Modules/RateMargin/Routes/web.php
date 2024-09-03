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

Route::prefix('admin-login/ratemargin')->group(function() {
    Route::get('/', 'RateMarginController@index')->name('ratemargin.index');
    Route::get('create', 'RateMarginController@create')->name('ratemargin.add');
    Route::post('save', 'RateMarginController@store')->name('ratemargin.save');
    Route::post('table-json', 'RateMarginController@tabledata')->name('ratemargin.data');
    Route::get('edit/{id}', 'RateMarginController@edit')->name('ratemargin.edit');
    Route::post('update/{id}', 'RateMarginController@update')->name('ratemargin.update');
    Route::post('delete', 'RateMarginController@delete')->name('ratemargin.delete');
}); 
