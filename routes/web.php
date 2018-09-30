<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'MainController@index');

Route::resource('/category', 'CategoryController');
Route::resource('/post', 'PostController');
