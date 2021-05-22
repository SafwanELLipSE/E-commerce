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
            Route::get('status/{id}', ['as' => 'status', 'uses' => 'Admin\SizeController@changeStatus']);
            Route::post('delete-selected', ['as' => 'delete_selected', 'uses' => 'Admin\SizeController@deleteSelectedSize']);
            Route::post('delete-all', ['as' => 'delete_all', 'uses' => 'Admin\SizeController@deleteAllSize']);
        });
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
        Route::group(['prefix' => 'color', 'as' => 'color.'], function () {
            Route::get('/', ['as' => 'index', 'uses' => 'Admin\ColorController@index']);
            Route::post('create', ['as' => 'create', 'uses' => 'Admin\ColorController@storeColor']);
            Route::post('list', ['as' => 'list', 'uses' => 'Admin\ColorController@allColorList']);
            Route::get('edit/{id}', ['as' => 'edit', 'uses' => 'Admin\ColorController@editColor']);
            Route::post('update', ['as' => 'update', 'uses' => 'Admin\ColorController@updateColor']);
            Route::post('delete', ['as' => 'delete', 'uses' => 'Admin\ColorController@destroyColor']);
            Route::post('delete-selected', ['as' => 'delete_selected', 'uses' => 'Admin\ColorController@deleteSelectedColor']);
            Route::post('delete-all', ['as' => 'delete_all', 'uses' => 'Admin\ColorController@deleteAllColor']);
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
            Route::get('list-view', ['as' => 'list_view', 'uses' => 'Admin\ProductController@displayProductList']);
            Route::post('create', ['as' => 'create', 'uses' => 'Admin\ProductController@storeProduct']);
            Route::post('list', ['as' => 'list', 'uses' => 'Admin\ProductController@allProductList']);
            Route::get('display/{id}', ['as' => 'display', 'uses' => 'Admin\ProductController@displayProduct']);
            Route::get('edit/{id}', ['as' => 'edit', 'uses' => 'Admin\ProductController@editProduct']);
            Route::post('update', ['as' => 'update', 'uses' => 'Admin\ProductController@updateProduct']);
            Route::post('delete', ['as' => 'delete', 'uses' => 'Admin\ProductController@destroyProduct']);
            Route::get('status/{id}', ['as' => 'status', 'uses' => 'Admin\ProductController@changeStatus']);
        });
        Route::group(['prefix' => 'productImages', 'as' => 'productImages.'], function () {
            Route::get('internals/{id}', ['as' => 'internals', 'uses' => 'Admin\ProductSliderImageController@index']);
            Route::post('create', ['as' => 'create', 'uses' => 'Admin\ProductSliderImageController@storeImage']);
            Route::post('update', ['as' => 'update', 'uses' => 'Admin\ProductSliderImageController@updateImage']);
            Route::post('delete', ['as' => 'delete', 'uses' => 'Admin\ProductSliderImageController@destroyImage']);
        });
        Route::group(['prefix' => 'discount', 'as' => 'discount.'], function () {
            Route::get('/', ['as' => 'index', 'uses' => 'Admin\DiscountController@index']);
            Route::get('list-view', ['as' => 'list_view', 'uses' => 'Admin\DiscountController@displayDiscountList']);
            Route::post('create', ['as' => 'create', 'uses' => 'Admin\DiscountController@storeDiscount']);
            Route::post('list', ['as' => 'list', 'uses' => 'Admin\DiscountController@allDiscountList']);
            Route::get('edit/{id}', ['as' => 'edit', 'uses' => 'Admin\DiscountController@editDiscount']);
            Route::post('update', ['as' => 'update', 'uses' => 'Admin\DiscountController@updateDiscount']);
            Route::post('delete', ['as' => 'delete', 'uses' => 'Admin\DiscountController@destroyDiscount']);
            Route::post('delete-selected', ['as' => 'delete_selected', 'uses' => 'Admin\DiscountController@deleteSelectedStock']);
            Route::post('delete-all', ['as' => 'delete_all', 'uses' => 'Admin\DiscountController@deleteAllStock']);
        });
    });
    Route::group(['prefix' => 'utilize', 'as' => 'utilize.'], function () {
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
    });
});