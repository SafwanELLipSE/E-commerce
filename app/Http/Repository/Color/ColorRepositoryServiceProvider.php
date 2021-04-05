<?php

namespace App\Http\Repository\Color;

use Illuminate\Support\ServiceProvider;

class ColorRepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            'App\Http\Repository\Color\ColorInterface',
            'App\Http\Repository\Color\ColorRepository'
        );
    }
}
