
<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'size', 'as' => 'size.'], function () {
    Route::get('/', ['as' => 'index', 'uses' => 'Admin\SizeController@index']);
    Route::post('create', ['as' => 'create', 'uses' => 'Admin\SizeController@storeSize']);
    Route::post('list', ['as' => 'list', 'uses' => 'Admin\SizeController@allSizeList']);
    Route::get('edit/{id}', ['as' => 'edit', 'uses' => 'Admin\SizeController@editSize']);
    Route::post('update', ['as' => 'update', 'uses' => 'Admin\SizeController@updateSize']);
    Route::post('delete', ['as' => 'delete', 'uses' => 'Admin\SizeController@destroySize']);
    Route::get('status/{id}', ['as' => 'status', 'uses' => 'Admin\SizeController@changeStatus']);
    Route::post('delete-selected', ['as' => 'delete_selected', 'uses' => 'Admin\SizeController@deleteSelectedSize']);
    Route::post('delete-all', ['as' => 'delete_all', 'uses' => 'Admin\SizeController@deleteAllSize']);
});
