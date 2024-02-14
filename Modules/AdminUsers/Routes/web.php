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

Route::prefix('admin-login/admin')->group(function() {
    Route::get('/', 'AdminUsersController@index')->name('admin-user.index');
    Route::get('create', 'AdminUsersController@create')->name('admin-user.add');
    Route::post('save', 'AdminUsersController@store')->name('admin-user.save');
    Route::post('table-json', 'AdminUsersController@tabledata')->name('admin-user.data');
    Route::get('edit/{id}', 'AdminUsersController@edit')->name('admin-user.edit');
    Route::post('update/{id}', 'AdminUsersController@update')->name('admin-user.update');
    Route::post('status/{id}', 'AdminUsersController@status')->name('admin-user.status');
    Route::post('delete', 'AdminUsersController@delete')->name('admin-user.delete');
    
    Route::get('export', 'AdminUsersController@export')->name('adminuser.export');
    Route::get('print', 'AdminUsersController@print')->name('adminuser.print');
});
