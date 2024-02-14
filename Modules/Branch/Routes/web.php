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

Route::prefix('admin-login/branch')->group(function() {
    Route::get('/', 'BranchController@index')->name('branch.index');
    Route::get('create', 'BranchController@create')->name('branch.add');
    Route::post('save', 'BranchController@store')->name('branch.save');
    Route::post('table-json', 'BranchController@tabledata')->name('branch.data');
    Route::get('edit/{id}', 'BranchController@edit')->name('branch.edit');
    Route::post('update/{id}', 'BranchController@update')->name('branch.update');
    Route::post('delete', 'BranchController@delete')->name('branch.delete');
    Route::post('status/{id}', 'BranchController@status')->name('branch.status');
    Route::post('reset/{id}', 'BranchController@reset')->name('branch.reset');
    
    Route::get('export', 'BranchController@export')->name('adminbranch.export');
    Route::get('print', 'BranchController@print')->name('adminbranch.print');
});
