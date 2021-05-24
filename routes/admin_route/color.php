<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'color', 'as' => 'color.'], function () {
    Route::get('/', ['as' => 'index', 'uses' => 'Admin\ColorController@index']);
    Route::post('create', ['as' => 'create', 'uses' => 'Admin\ColorController@storeColor']);
    Route::post('list', ['as' => 'list', 'uses' => 'Admin\ColorController@allColorList']);
    Route::get('edit/{id}', ['as' => 'edit', 'uses' => 'Admin\ColorController@editColor']);
    Route::post('update', ['as' => 'update', 'uses' => 'Admin\ColorController@updateColor']);
    Route::post('delete', ['as' => 'delete', 'uses' => 'Admin\ColorController@destroyColor']);
    Route::post('delete-selected', ['as' => 'delete_selected', 'uses' => 'Admin\ColorController@deleteSelectedColor']);
    Route::post('delete-all', ['as' => 'delete_all', 'uses' => 'Admin\ColorController@deleteAllColor']);
});