<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'subCategory', 'as' => 'subCategory.'], function () {
    Route::get('/', ['as' => 'index', 'uses' => 'Admin\SubCategoryController@index']);
    Route::post('create', ['as' => 'create', 'uses' => 'Admin\SubCategoryController@storeSubcategory']);
    Route::post('list', ['as' => 'list', 'uses' => 'Admin\SubCategoryController@allSubCategoryList']);
    Route::get('edit/{id}', ['as' => 'edit', 'uses' => 'Admin\SubCategoryController@editSubcategory']);
    Route::post('update', ['as' => 'update', 'uses' => 'Admin\SubCategoryController@updateSubcategory']);
    Route::post('delete', ['as' => 'delete', 'uses' => 'Admin\SubCategoryController@destroySubcategory']);
    Route::get('status/{id}', ['as' => 'status', 'uses' => 'Admin\SubCategoryController@changeStatus']);
    Route::post('delete-selected', ['as' => 'delete_selected', 'uses' => 'Admin\SubCategoryController@deleteSelectedSubcategory']);
    Route::post('delete-all', ['as' => 'delete_all', 'uses' => 'Admin\SubCategoryController@deleteAllSubcategory']);
});