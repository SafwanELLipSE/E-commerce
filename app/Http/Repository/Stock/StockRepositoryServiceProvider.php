<?php

namespace App\Http\Repository\Stock;

use Illuminate\Support\ServiceProvider;

class StockRepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            'App\Http\Repository\Stock\StockInterface',
            'App\Http\Repository\Stock\StockRepository'
        );
    }
}
