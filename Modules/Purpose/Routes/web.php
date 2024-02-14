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

Route::prefix('admin-login/purpose')->group(function() {
    Route::get('/', 'PurposeController@index')->name('purpose.index');
    Route::get('create', 'PurposeController@create')->name('purpose.add');
    Route::post('save', 'PurposeController@store')->name('purpose.save');
    Route::post('table-json', 'PurposeController@tabledata')->name('purpose.data');
    Route::get('edit/{id}', 'PurposeController@edit')->name('purpose.edit');
    Route::post('update/{id}', 'PurposeController@update')->name('purpose.update');
    Route::post('delete', 'PurposeController@delete')->name('purpose.delete');
    Route::post('status/{id}', 'PurposeController@status')->name('purpose.status');
});
