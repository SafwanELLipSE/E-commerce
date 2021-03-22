<?php

namespace App\Http\Repository\Slider;
use Illuminate\Support\ServiceProvider;
class SliderRepositoryServiceProvider extends ServiceProvider{
    public function register(){
        $this->app->bind(
            'App\Http\Repository\Slider\SliderInterface',
            'App\Http\Repository\Slider\SliderRepository'
        );
    }
}
