<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'feature', 'as' => 'feature.'], function () {
    Route::get('/', ['as' => 'index', 'uses' => 'Admin\FeatureController@index']);
    Route::post('create', ['as' => 'create', 'uses' => 'Admin\FeatureController@storeFeature']);
    Route::post('list', ['as' => 'list', 'uses' => 'Admin\FeatureController@allFeatureList']);
    Route::get('edit/{id}', ['as' => 'edit', 'uses' => 'Admin\FeatureController@editFeature']);
    Route::post('update', ['as' => 'update', 'uses' => 'Admin\FeatureController@updateFeature']);
    Route::post('delete', ['as' => 'delete', 'uses' => 'Admin\FeatureController@destroyFeature']);
    Route::post('delete-selected', ['as' => 'delete_selected', 'uses' => 'Admin\FeatureController@deleteSelectedFeature']);
    Route::post('delete-all', ['as' => 'delete_all', 'uses' => 'Admin\FeatureController@deleteAllFeature']);
});