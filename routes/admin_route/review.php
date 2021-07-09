<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'discount', 'as' => 'discount.'], function () {
    Route::get('/', ['as' => 'index', 'uses' => 'Admin\ReviewController@index']);
    Route::get('list-view', ['as' => 'list_view', 'uses' => 'Admin\ReviewController@displayDiscountList']);
    Route::post('create', ['as' => 'create', 'uses' => 'Admin\ReviewController@storeDiscount']);
    Route::post('list', ['as' => 'list', 'uses' => 'Admin\ReviewController@allDiscountList']);
    Route::get('edit/{id}', ['as' => 'edit', 'uses' => 'Admin\ReviewController@editDiscount']);
    Route::post('update', ['as' => 'update', 'uses' => 'Admin\ReviewController@updateDiscount']);
    Route::post('delete', ['as' => 'delete', 'uses' => 'Admin\ReviewController@destroyDiscount']);
    Route::post('delete-selected', ['as' => 'delete_selected', 'uses' => 'Admin\ReviewController@deleteSelectedDiscount']);
    Route::post('delete-all', ['as' => 'delete_all', 'uses' => 'Admin\ReviewController@deleteAllDiscount']);
});
