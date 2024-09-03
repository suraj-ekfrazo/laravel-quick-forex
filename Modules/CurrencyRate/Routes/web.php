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

Route::prefix('admin-login/currencyrate')->group(function() {
    Route::get('/', 'CurrencyRateController@index')->name('currencyrate.index');
    Route::get('create', 'CurrencyRateController@create')->name('currencyrate.add');
    Route::post('save', 'CurrencyRateController@store')->name('currencyrate.save');
    Route::post('table-json', 'CurrencyRateController@tabledata')->name('currencyrate.data');
    Route::get('edit/{id}', 'CurrencyRateController@edit')->name('currencyrate.edit');
    Route::post('update/{id}', 'CurrencyRateController@update')->name('currencyrate.update');
    Route::post('delete', 'CurrencyRateController@delete')->name('currencyrate.delete');
}); 
