<?php

namespace App\Http\Repository\Category;

use Illuminate\Support\ServiceProvider;

class CategoryRepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            'App\Http\Repository\Category\CategoryInterface',
            'App\Http\Repository\Category\CategoryRepository'
        );
    }
}
