<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'category', 'as' => 'category.'], function () {
    Route::get('/', ['as' => 'index', 'uses' => 'Admin\CategoryController@index']);
    Route::post('create', ['as' => 'create', 'uses' => 'Admin\CategoryController@storeCategory']);
    Route::post('list', ['as' => 'list', 'uses' => 'Admin\CategoryController@allCategoryList']);
    Route::get('edit/{id}', ['as' => 'edit', 'uses' => 'Admin\CategoryController@editCategory']);
    Route::post('update', ['as' => 'update', 'uses' => 'Admin\CategoryController@updateCategory']);
    Route::post('delete', ['as' => 'delete', 'uses' => 'Admin\CategoryController@destroyCategory']);
    Route::get('status/{id}', ['as' => 'status', 'uses' => 'Admin\CategoryController@changeStatus']);
    Route::post('delete-selected', ['as' => 'delete_selected', 'uses' => 'Admin\CategoryController@deleteSelectedCategory']);
    Route::post('delete-all', ['as' => 'delete_all', 'uses' => 'Admin\CategoryController@deleteAllCategory']);
});