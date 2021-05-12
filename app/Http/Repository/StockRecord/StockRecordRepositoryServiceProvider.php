<?php

namespace App\Http\Repository\StockRecord;

use Illuminate\Support\ServiceProvider;

class StockRecordRepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            'App\Http\Repository\StockRecord\StockRecordInterface',
            'App\Http\Repository\StockRecord\StockRecordRepository'
        );
    }
}
