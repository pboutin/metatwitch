<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('login', function() {
    return View::make('login');
});

Route::get('dashboard', function() {
    return View::make('dashboard');
});

Route::get('room', function() {
    return View::make('room');
});