<?php
namespace App\Http\Repository\Brand;
use Illuminate\Support\ServiceProvider;
class BrandRepositoryServiceProvider extends ServiceProvider{
    public function register(){
        $this->app->bind(
            'App\Http\Repository\Brand\BrandInterface',
            'App\Http\Repository\Brand\BrandRepository'
        );
    }
}