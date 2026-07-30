<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('posts.index');
});

Route::get('/profile', function () {
    return view('profile.index');
});

Route::get('/explore', function () {
    return view('explore.index');
});
