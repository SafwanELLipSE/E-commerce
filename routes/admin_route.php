<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/web_admin', function () {
    return redirect('dashboard');
});

Auth::routes();

Route::group(['middleware' => ['auth']], function () {

    Route::get('/logout', ['uses' => 'Auth\LoginController@logout']);
    Route::get('/dashboard', ['as' => 'dashboard', 'uses' => 'Admin\UserController@index']);

    Route::group(['prefix' => 'customize', 'as' => 'customize.'], function () {
        require __DIR__ . '/admin_route/brand.php';
        require __DIR__ . '/admin_route/category.php';
        require __DIR__ . '/admin_route/subCategory.php';
        require __DIR__ . '/admin_route/size.php';
        require __DIR__ . '/admin_route/feature.php';
        require __DIR__ . '/admin_route/color.php';
        require __DIR__ . '/admin_route/slider.php';
        require __DIR__ . '/admin_route/product.php';
        require __DIR__ . '/admin_route/discount.php';
    });
    Route::group(['prefix' => 'utilize', 'as' => 'utilize.'], function () {
        require __DIR__ . '/admin_route/stock.php';
    });
});