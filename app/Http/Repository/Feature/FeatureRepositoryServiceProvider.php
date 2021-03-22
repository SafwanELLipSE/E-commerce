<?php

namespace App\Http\Repository\Feature;
use Illuminate\Support\ServiceProvider;
class FeatureRepositoryServiceProvider extends ServiceProvider{
    public function register(){
        $this->app->bind(
            'App\Http\Repository\Feature\FeatureInterface',
            'App\Http\Repository\Feature\FeatureRepository'
        );
    }
}
