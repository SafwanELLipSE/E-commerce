<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'product', 'as' => 'product.'], function () {
    Route::get('/', ['as' => 'index', 'uses' => 'Admin\ProductController@index']);
    Route::get('list-view', ['as' => 'list_view', 'uses' => 'Admin\ProductController@displayProductList']);
    Route::post('create', ['as' => 'create', 'uses' => 'Admin\ProductController@storeProduct']);
    Route::post('list', ['as' => 'list', 'uses' => 'Admin\ProductController@allProductList']);
    Route::get('display/{id}', ['as' => 'display', 'uses' => 'Admin\ProductController@displayProduct']);
    Route::get('edit/{id}', ['as' => 'edit', 'uses' => 'Admin\ProductController@editProduct']);
    Route::post('update', ['as' => 'update', 'uses' => 'Admin\ProductController@updateProduct']);
    Route::post('delete', ['as' => 'delete', 'uses' => 'Admin\ProductController@destroyProduct']);
    Route::get('status/{id}', ['as' => 'status', 'uses' => 'Admin\ProductController@changeStatus']);
    Route::post('delete-selected', ['as' => 'delete_selected', 'uses' => 'Admin\ProductController@deleteSelectedProduct']);
    Route::post('delete-all', ['as' => 'delete_all', 'uses' => 'Admin\ProductController@deleteAllProduct']);
});

Route::group(['prefix' => 'productImages', 'as' => 'productImages.'], function () {
    Route::get('internals/{id}', ['as' => 'internals', 'uses' => 'Admin\ProductSliderImageController@index']);
    Route::post('create', ['as' => 'create', 'uses' => 'Admin\ProductSliderImageController@storeImage']);
    Route::post('update', ['as' => 'update', 'uses' => 'Admin\ProductSliderImageController@updateImage']);
    Route::post('delete', ['as' => 'delete', 'uses' => 'Admin\ProductSliderImageController@destroyImage']);
});