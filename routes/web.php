<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('arcgis', function() {
    return view('arcgis');
});

Route::get('home', function () {
    return view('home');
});
