<?php

use Illuminate\Support\Facades\Route;

Route::post('/comment', 'Api\CommentController@store');
Route::get('/comment', 'Api\CommentController@store');
