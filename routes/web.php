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
            Route::post('create', ['as' => 'create', 'uses' => 'Admin\BrandController@storeBrand']);
            Route::post('list', ['as' => 'list', 'uses' => 'Admin\BrandController@allBrandList']);
            Route::get('edit/{id}', ['as' => 'edit', 'uses' => 'Admin\BrandController@editBrand']);
            Route::post('update', ['as' => 'update', 'uses' => 'Admin\BrandController@updateBrand']);
            Route::post('delete', ['as' => 'delete', 'uses' => 'Admin\BrandController@destroyBrand']);
            Route::get('status/{id}', ['as' => 'status', 'uses' => 'Admin\BrandController@changeStatus']);
        });
        Route::group(['prefix' => 'category', 'as' => 'category.'], function () {
            Route::get('/', ['as' => 'index', 'uses' => 'Admin\CategoryController@index']);
            Route::post('create', ['as' => 'create', 'uses' => 'Admin\CategoryController@storeCategory']);
            Route::post('list', ['as' => 'list', 'uses' => 'Admin\CategoryController@allCategoryList']);
            Route::get('edit/{id}', ['as' => 'edit', 'uses' => 'Admin\CategoryController@editCategory']);
            Route::post('update', ['as' => 'update', 'uses' => 'Admin\CategoryController@updateCategory']);
            Route::post('delete', ['as' => 'delete', 'uses' => 'Admin\CategoryController@destroyCategory']);
            Route::get('status/{id}', ['as' => 'status', 'uses' => 'Admin\CategoryController@changeStatus']);
        });
        Route::group(['prefix' => 'subCategory', 'as' => 'subCategory.'], function () {
            Route::get('/', ['as' => 'index', 'uses' => 'Admin\SubCategoryController@index']);
            Route::post('create', ['as' => 'create', 'uses' => 'Admin\SubCategoryController@storeSubcategory']);
            Route::post('list', ['as' => 'list', 'uses' => 'Admin\SubCategoryController@allSubCategoryList']);
            Route::get('edit/{id}', ['as' => 'edit', 'uses' => 'Admin\SubCategoryController@editSubcategory']);
            Route::post('update', ['as' => 'update', 'uses' => 'Admin\SubCategoryController@updateSubcategory']);
            Route::post('delete', ['as' => 'delete', 'uses' => 'Admin\SubCategoryController@destroySubcategory']);
            Route::get('status/{id}', ['as' => 'status', 'uses' => 'Admin\SubCategoryController@changeStatus']);
        });
        Route::group(['prefix' => 'size', 'as' => 'size.'], function () {
            Route::get('/', ['as' => 'index', 'uses' => 'Admin\SizeController@index']);
            Route::post('create', ['as' => 'create', 'uses' => 'Admin\SizeController@storeSize']);
            Route::post('list', ['as' => 'list', 'uses' => 'Admin\SizeController@allSizeList']);
            Route::get('edit/{id}', ['as' => 'edit', 'uses' => 'Admin\SizeController@editSize']);
            Route::post('update', ['as' => 'update', 'uses' => 'Admin\SizeController@updateSize']);
            Route::post('delete', ['as' => 'delete', 'uses' => 'Admin\SizeController@destroySize']);
            Route::get('status/{id}', ['as' => 'status', 'uses' => 'Admin\SizeController@changeSize']);
        });
        Route::group(['prefix' => 'feature', 'as' => 'feature.'], function () {
            Route::get('/', ['as' => 'index', 'uses' => 'Admin\FeatureController@index']);
            Route::post('create', ['as' => 'create', 'uses' => 'Admin\FeatureController@storeFeature']);
            Route::post('list', ['as' => 'list', 'uses' => 'Admin\FeatureController@allFeatureList']);
            Route::get('edit/{id}', ['as' => 'edit', 'uses' => 'Admin\FeatureController@editFeature']);
            Route::post('update', ['as' => 'update', 'uses' => 'Admin\FeatureController@updateFeature']);
            Route::post('delete', ['as' => 'delete', 'uses' => 'Admin\FeatureController@destroyFeature']);
        });
        Route::group(['prefix' => 'slider', 'as' => 'slider.'], function () {
            Route::get('/', ['as' => 'index', 'uses' => 'Admin\SliderController@index']);
            Route::post('create', ['as' => 'create', 'uses' => 'Admin\SliderController@storeSlider']);
            Route::post('list', ['as' => 'list', 'uses' => 'Admin\SliderController@allSliderList']);
            Route::get('edit/{id}', ['as' => 'edit', 'uses' => 'Admin\SliderController@editSlider']);
            Route::post('update', ['as' => 'update', 'uses' => 'Admin\SliderController@updateSlider']);
            Route::post('delete', ['as' => 'delete', 'uses' => 'Admin\SliderController@destroySlider']);
            Route::get('status/{id}', ['as' => 'status', 'uses' => 'Admin\SliderController@changeStatus']);
        });
        Route::group(['prefix' => 'product', 'as' => 'product.'], function () {
            Route::get('/', ['as' => 'index', 'uses' => 'Admin\ProductController@index']);
            Route::get('list-view', ['list_view' => 'index', 'uses' => 'Admin\ProductController@diplayProductList']);
            Route::post('create', ['as' => 'create', 'uses' => 'Admin\ProductController@storeSlider']);
            Route::post('list', ['as' => 'list', 'uses' => 'Admin\ProductController@allSliderList']);
            Route::get('edit/{id}', ['as' => 'edit', 'uses' => 'Admin\ProductController@editSlider']);
            Route::post('update', ['as' => 'update', 'uses' => 'Admin\ProductController@updateSlider']);
            Route::post('delete', ['as' => 'delete', 'uses' => 'Admin\ProductController@destroySlider']);
            Route::get('status/{id}', ['as' => 'status', 'uses' => 'Admin\ProductController@changeStatus']);
        });
    });
});