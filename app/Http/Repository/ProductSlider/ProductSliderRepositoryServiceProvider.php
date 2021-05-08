<?php

namespace App\Http\Repository\ProductSlider;

use Illuminate\Support\ServiceProvider;

class ProductSliderRepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            'App\Http\Repository\ProductSlider\ProductSliderInterface',
            'App\Http\Repository\ProductSlider\ProductSliderRepository'
        );
    }
}
