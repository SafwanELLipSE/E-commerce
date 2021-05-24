<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'brand', 'as' => 'brand.'], function () {
    Route::get('/', ['as' => 'index', 'uses' => 'Admin\BrandController@index']);
    Route::post('create', ['as' => 'create', 'uses' => 'Admin\BrandController@storeBrand']);
    Route::post('list', ['as' => 'list', 'uses' => 'Admin\BrandController@allBrandList']);
    Route::get('edit/{id}', ['as' => 'edit', 'uses' => 'Admin\BrandController@editBrand']);
    Route::post('update', ['as' => 'update', 'uses' => 'Admin\BrandController@updateBrand']);
    Route::post('delete', ['as' => 'delete', 'uses' => 'Admin\BrandController@destroyBrand']);
    Route::get('status/{id}', ['as' => 'status', 'uses' => 'Admin\BrandController@changeStatus']);
    Route::post('delete-selected', ['as' => 'delete_selected', 'uses' => 'Admin\BrandController@deleteSelectedBrand']);
    Route::post('delete-all', ['as' => 'delete_all', 'uses' => 'Admin\BrandController@deleteAllBrand']);
});