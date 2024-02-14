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

Route::prefix('admin-login/settings')->group(function() {
    Route::get('/', 'SettingsController@index')->name('admin-login.index');
    Route::get('create', 'SettingsController@create')->name('settings.add');
    Route::post('save', 'SettingsController@store')->name('settings.save');
    Route::post('table-json', 'SettingsController@tabledata')->name('admin-login.data');
    Route::get('edit/{id}', 'SettingsController@edit')->name('settings.edit');
    Route::post('update/{id}', 'SettingsController@update')->name('settings.update');
    Route::post('delete', 'SettingsController@delete')->name('settings.delete');
    Route::post('status/{id}', 'SettingsController@status')->name('settings.status');
    Route::post('reset/{id}', 'SettingsController@reset')->name('settings.reset');
});

Route::prefix('admin-login/settings/managePurposes')->group(function() {
    Route::post('table-json', 'ManagePurposesController@tabledata')->name('managePurposes.data');
    Route::get('create', 'ManagePurposesController@create')->name('managePurposes.add');
    Route::post('save', 'ManagePurposesController@store')->name('managePurposes.save');
    Route::post('delete', 'ManagePurposesController@delete')->name('managePurposes.delete');
    Route::post('status/{id}', 'ManagePurposesController@status')->name('managePurposes.status');
    Route::get('edit/{id}', 'ManagePurposesController@edit')->name('managePurposes.edit');
    Route::get('view/{id}', 'ManagePurposesController@show')->name('managePurposes.view');
    Route::post('update/{id}', 'ManagePurposesController@update')->name('managePurposes.update');
});

Route::prefix('admin-login/settings/sources')->group(function() {
    Route::post('table-json', 'ManageSourcesController@tabledata')->name('sources.data');
    Route::get('create', 'ManageSourcesController@create')->name('sources.add');
    Route::post('save', 'ManageSourcesController@store')->name('sources.save');
    Route::post('delete', 'ManageSourcesController@delete')->name('sources.delete');
    Route::post('status/{id}', 'ManageSourcesController@status')->name('sources.status');
    Route::get('edit/{id}', 'ManageSourcesController@edit')->name('sources.edit');
    Route::get('view/{id}', 'ManageSourcesController@show')->name('sources.view');
    Route::post('update/{id}', 'ManageSourcesController@update')->name('sources.update');
});

Route::prefix('admin-login/settings/customers')->group(function() {
    Route::post('table-json', 'CustomersController@tabledata')->name('customers.data');
    Route::get('create', 'CustomersController@create')->name('customers.add');
    Route::post('save', 'CustomersController@store')->name('customers.save');
    Route::post('delete', 'CustomersController@delete')->name('customers.delete');
    Route::post('status/{id}', 'CustomersController@status')->name('customers.status');
    Route::get('edit/{id}', 'CustomersController@edit')->name('customers.edit');
    Route::post('update/{id}', 'CustomersController@update')->name('customers.update');
});
