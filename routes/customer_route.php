<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return redirect('home');
});

Auth::routes();

Route::get('/home', ['as' => 'home', 'uses' => 'Front\HomeController@index']);
