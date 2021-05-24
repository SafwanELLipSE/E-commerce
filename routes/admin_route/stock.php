<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'stock', 'as' => 'stock.'], function () {
    Route::get('/', ['as' => 'index', 'uses' => 'Admin\StockController@index']);
    Route::post('create', ['as' => 'create', 'uses' => 'Admin\StockController@storeStock']);
    Route::get('list-view', ['as' => 'list_view', 'uses' => 'Admin\StockController@displayAllStock']);
    Route::post('list', ['as' => 'list', 'uses' => 'Admin\StockController@allStockList']);
    Route::post('save-restock', ['as' => 'save_restock', 'uses' => 'Admin\StockController@reStockStock']);
    Route::post('save-in', ['as' => 'save_in', 'uses' => 'Admin\StockController@inStock']);
    Route::post('save-out', ['as' => 'save_out', 'uses' => 'Admin\StockController@outStock']);
    Route::get('display/{id}', ['as' => 'display', 'uses' => 'Admin\StockController@displayStock']);
    Route::post('update', ['as' => 'update', 'uses' => 'Admin\StockController@updateStock']);
    Route::post('delete', ['as' => 'delete', 'uses' => 'Admin\StockController@destroyStock']);
    Route::post('delete-selected', ['as' => 'delete_selected', 'uses' => 'Admin\StockController@deleteSelectedStock']);
    Route::post('delete-all', ['as' => 'delete_all', 'uses' => 'Admin\StockController@deleteAllStock']);
});

Route::group(['prefix' => 'stockRecord', 'as' => 'stockRecord.'], function () {
    Route::get('view/{id}', ['as' => 'view', 'uses' => 'Admin\StockRecordController@displayAllStockRecord']);
    Route::get('excel-report/{id}', ['as' => 'excel_report', 'uses' => 'Admin\StockRecordController@excelReport']);
});