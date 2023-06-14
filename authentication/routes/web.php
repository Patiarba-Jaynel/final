<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    echo "<center><h1>Nothing to see here.</h1></center>";
    return $router->app->version();
});

Route::group([

    'prefix' => 'api'

], function ($router) {
    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::get('user-profile', 'AuthController@me');
    Route::post('create', 'userController@register');

    Route::get('hello', 'userController@hello');
});

$router->group(['prefix' => 'api/v1'], function($router) {
    $router->post('/payment', 'paymongoController@pay');
    $router->post('/chat', 'gptController@chat');
});


// chatgpt Integration

