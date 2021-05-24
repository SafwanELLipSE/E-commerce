<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'slider', 'as' => 'slider.'], function () {
    Route::get('/', ['as' => 'index', 'uses' => 'Admin\SliderController@index']);
    Route::post('create', ['as' => 'create', 'uses' => 'Admin\SliderController@storeSlider']);
    Route::post('list', ['as' => 'list', 'uses' => 'Admin\SliderController@allSliderList']);
    Route::get('edit/{id}', ['as' => 'edit', 'uses' => 'Admin\SliderController@editSlider']);
    Route::post('update', ['as' => 'update', 'uses' => 'Admin\SliderController@updateSlider']);
    Route::post('delete', ['as' => 'delete', 'uses' => 'Admin\SliderController@destroySlider']);
    Route::get('status/{id}', ['as' => 'status', 'uses' => 'Admin\SliderController@changeStatus']);
    Route::post('delete-selected', ['as' => 'delete_selected', 'uses' => 'Admin\SliderController@deleteSelectedSlider']);
    Route::post('delete-all', ['as' => 'delete_all', 'uses' => 'Admin\SliderController@deleteAllSlider']);
});