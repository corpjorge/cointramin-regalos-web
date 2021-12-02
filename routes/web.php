<?php

/** @var \Laravel\Lumen\Routing\Router $router */

$router->get('/', 'AsociadoController@index');
$router->post('/login', 'AuthController@login');

$router->group(['middleware' => 'auth'], function () use ($router) {

    $router->post('/logout', 'AuthController@logout');
    $router->get('user', 'AuthController@user');

    $router->post('/buscar', 'AsociadoController@buscar');
    $router->get('/asociado/{asociado}', 'AsociadoController@asociado');
    $router->post('/entregar/{asociado}', 'AsociadoController@entregar');
    $router->delete('/asociado/{user}', 'AsociadoController@destroy');
    $router->post('/asociados/import/', 'AsociadoController@import');

    //Users
//    $router->get('/config-search/users/{user?}', 'UserController@usersFind');
//    $router->get('/users', 'UserController@index');
//    $router->post('/users', 'UserController@store');
//    $router->get('/users/{users}/edit', 'UserController@edit');
//    $router->put('/users/{users}', 'UserController@update');


});

$router->get('/asociados/export/', 'AsociadoController@export');



