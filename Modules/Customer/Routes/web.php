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

Route::prefix('admin-login/customer')->group(function() {
    Route::get('/', 'CustomerController@index')->name('customer.index');
    Route::get('create', 'CustomerController@create')->name('customer.add');
    Route::post('save', 'CustomerController@store')->name('customer.save');
    Route::post('table-json', 'CustomerController@tabledata')->name('customer.data');
    Route::get('edit/{id}', 'CustomerController@edit')->name('customer.edit');
    Route::post('update/{id}', 'CustomerController@update')->name('customer.update');
    Route::post('delete', 'CustomerController@delete')->name('customer.delete');
    
    Route::get('export', 'CustomerController@export')->name('admincustomer.export');
    Route::get('print', 'CustomerController@print')->name('admincustomer.print');
});
