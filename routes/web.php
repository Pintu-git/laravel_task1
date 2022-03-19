<?php

use Illuminate\Support\Facades\Route;


Route::get('/welcome', function () {
    return view('welcome');
});


 Route::get('/login','App\Http\Controllers\user@login');
 Route::get('/signup','App\Http\Controllers\user@signup');
 Route::get('/','App\Http\Controllers\user@login');
 Route::get('/profile','App\Http\Controllers\user@profile');
 Route::get('/update','App\Http\Controllers\user@update');
 Route::get('/logout','App\Http\Controllers\user@logout');



 Route::post('/submit','App\Http\Controllers\user@form_submit');
 Route::post('/loginCheck','App\Http\Controllers\user@loginCheck');
 Route::post('/updateFor','App\Http\Controllers\user@updateFor');