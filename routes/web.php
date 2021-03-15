<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', function () {
    return redirect('home');
});
Route::get('/home', ['as' => 'home', 'uses' => 'Front\HomeController@index']);


Route::get('/web_admin', function () {
    return redirect('dashboard');
});

Auth::routes();

Route::group(['middleware' => ['auth']], function () {
    
    Route::get('/logout', ['uses' => 'Auth\LoginController@logout']);
    Route::get('/dashboard', ['as' => 'dashboard', 'uses' => 'Admin\UserController@index']);
    
    Route::group(['prefix' => 'customize', 'as' => 'customize.'], function () {
        Route::group(['prefix' => 'brand', 'as' => 'brand.'], function () {
            Route::get('/', ['as' => 'index', 'uses' => 'Admin\BrandController@index']);
            Route::get('create', ['as' => 'create', 'uses' => 'Admin\BrandController@storeBrand']);
            Route::post('view-list', ['as' => 'view_list', 'uses' => 'Admin\BrandController@store']);
            Route::post('update', ['as' => 'update', 'uses' => 'Admin\BrandController@editBrand']);
        });
        Route::group(['prefix' => 'category', 'as' => 'category.'], function () {
            Route::get('/', ['as' => 'index', 'uses' => 'Admin\CategoryController@index']);
            Route::get('view-list', ['as' => 'view_list', 'uses' => 'Admin\CategoryController@getCategoryList']);
            Route::post('update', ['as' => 'update', 'uses' => 'Admin\CategoryController@editCategory']);
        });
        Route::group(['prefix' => 'subCategory', 'as' => 'subCategory.'], function () {
            Route::get('/', ['as' => 'index', 'uses' => 'Admin\SubCategoryController@index']);
            Route::get('list', ['as' => 'list', 'uses' => 'Admin\SubCategoryController@getCategoryList']);
            Route::post('update', ['as' => 'update', 'uses' => 'Admin\SubCategoryController@editCategory']);
        });
    });
});