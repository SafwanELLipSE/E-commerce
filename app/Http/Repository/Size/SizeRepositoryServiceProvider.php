<?php

namespace App\Http\Repository\Size;
use Illuminate\Support\ServiceProvider;
class SizeRepositoryServiceProvider extends ServiceProvider{
    public function register(){
        $this->app->bind(
            'App\Http\Repository\Size\SizeInterface',
            'App\Http\Repository\Size\SizeRepository'
        );
    }
}