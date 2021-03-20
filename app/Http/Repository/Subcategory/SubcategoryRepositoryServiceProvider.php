<?php

namespace App\Http\Repository\Subcategory;

use Illuminate\Support\ServiceProvider;

class SubcategoryRepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            'App\Http\Repository\Subcategory\SubcategoryInterface',
            'App\Http\Repository\Subcategory\SubcategoryRepository'
        );
    }
}
