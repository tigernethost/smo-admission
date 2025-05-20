<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/kiosk', function () {
    return redirect('/kiosk/enlisting');
});
Route::get('/kiosk/enlisting', function () {
    return view('kiosk.enlisting');
});
