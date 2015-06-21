<?php

/** @var \Illuminate\Routing\Router $router */

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

$router->get('/', [
    'as' => 'index',
    'uses' => 'HomeController@index'
]);


$router->get('/login', [
    'as' => 'login',
    'uses' => 'TwitchOauthController@login'
]);

$router->get('/logout', [
    'as' => 'logout',
    'uses' => 'TwitchOauthController@logout'
]);

$router->group(['middleware' => ['auth']], function() use ($router){

    $router->get('/home', [
        'as' => 'home',
        'uses' => 'UserController@home'
    ]);

    $router->post('/room', [
        'as' => 'gotoRoom',
        'uses' => 'UserController@gotoRoom'
    ]);

    $router->get('/room', [
        'as' => 'room',
        'uses' => 'UserController@room'
    ]);

});
