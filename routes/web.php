<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('backend.app');
});

Route::get('/login', function () {
    return view('Auth.login');
})->name('login');
