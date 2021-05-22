<?php

namespace App\Http\Repository\Discount;

use Illuminate\Support\ServiceProvider;

class DiscountRepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            'App\Http\Repository\Discount\DiscountInterface',
            'App\Http\Repository\Discount\DiscountRepository'
        );
    }
}
