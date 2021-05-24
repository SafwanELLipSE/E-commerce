<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'discount', 'as' => 'discount.'], function () {
    Route::get('/', ['as' => 'index', 'uses' => 'Admin\DiscountController@index']);
    Route::get('list-view', ['as' => 'list_view', 'uses' => 'Admin\DiscountController@displayDiscountList']);
    Route::post('create', ['as' => 'create', 'uses' => 'Admin\DiscountController@storeDiscount']);
    Route::post('list', ['as' => 'list', 'uses' => 'Admin\DiscountController@allDiscountList']);
    Route::get('edit/{id}', ['as' => 'edit', 'uses' => 'Admin\DiscountController@editDiscount']);
    Route::post('update', ['as' => 'update', 'uses' => 'Admin\DiscountController@updateDiscount']);
    Route::post('delete', ['as' => 'delete', 'uses' => 'Admin\DiscountController@destroyDiscount']);
    Route::post('delete-selected', ['as' => 'delete_selected', 'uses' => 'Admin\DiscountController@deleteSelectedDiscount']);
    Route::post('delete-all', ['as' => 'delete_all', 'uses' => 'Admin\DiscountController@deleteAllDiscount']);
});