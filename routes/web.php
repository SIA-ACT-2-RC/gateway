<?php

/** @var \Laravel\Lumen\Routing\Router $router */

$router->get('/', function () use ($router) {
    return $router->app->version();
});

/*
|--------------------------------------------------------------------------
| USER 1 (CRUD)
|--------------------------------------------------------------------------
*/

$router->get('/users1', ['middleware' => 'auth', 'uses' => 'User1Controller@index']);
$router->post('/users1', ['middleware' => 'auth', 'uses' => 'User1Controller@add']);
$router->get('/users1/{id}', ['middleware' => 'auth', 'uses' => 'User1Controller@show']);
$router->put('/users1/{id}', ['middleware' => 'auth', 'uses' => 'User1Controller@update']);
$router->delete('/users1/{id}', ['middleware' => 'auth', 'uses' => 'User1Controller@delete']);

/*
|--------------------------------------------------------------------------
| USER 2 (CRUD)
|--------------------------------------------------------------------------
*/

$router->get('/users2', ['middleware' => 'auth', 'uses' => 'User2Controller@index']);
$router->post('/users2', ['middleware' => 'auth', 'uses' => 'User2Controller@add']);
$router->get('/users2/{id}', ['middleware' => 'auth', 'uses' => 'User2Controller@show']);
$router->put('/users2/{id}', ['middleware' => 'auth', 'uses' => 'User2Controller@update']);
$router->delete('/users2/{id}', ['middleware' => 'auth', 'uses' => 'User2Controller@delete']);

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/

$router->post('/login', 'AuthController@login');

/*
|--------------------------------------------------------------------------
| MICROSERVICE VIA GATEWAY
|--------------------------------------------------------------------------
*/

$router->get('/users', ['middleware' => 'auth', function () {

    $user1 = app('App\Http\Controllers\User1Controller');
    $user2 = app('App\Http\Controllers\User2Controller');

    return [
        'site1' => json_decode($user1->index()->getContent(), true),
        'site2' => json_decode($user2->index()->getContent(), true),
    ];
}]);
