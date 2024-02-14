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

Route::prefix('admin-login/source')->group(function() {
    Route::get('/', 'SourceController@index')->name('source.index');
    Route::get('create', 'SourceController@create')->name('source.add');
    Route::post('save', 'SourceController@store')->name('source.save');
    Route::post('table-json', 'SourceController@tabledata')->name('source.data');
    Route::get('edit/{id}', 'SourceController@edit')->name('source.edit');
    Route::post('update/{id}', 'SourceController@update')->name('source.update');
    Route::post('delete', 'SourceController@delete')->name('source.delete');
    Route::post('status/{id}', 'SourceController@status')->name('source.status');
});
