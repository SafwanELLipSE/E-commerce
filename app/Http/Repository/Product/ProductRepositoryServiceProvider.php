<?php

namespace App\Http\Repository\Product;

use Illuminate\Support\ServiceProvider;

class ProductRepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            'App\Http\Repository\Product\ProductInterface',
            'App\Http\Repository\Product\ProductRepository'
        );
    }
}
