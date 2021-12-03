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
    $router->post('/asociado', 'AsociadoController@store');
    $router->delete('/asociado/{user}', 'AsociadoController@destroy');
    $router->post('/asociados/import/', 'AsociadoController@import');

    //Users
    $router->get('/config-search/users/{user?}', 'UsersController@usersFind');
    $router->get('/users', 'UsersController@index');
    $router->post('/users', 'UsersController@store');
    $router->get('/users/{user}/edit', 'UsersController@edit');
    $router->put('/users/{user}', 'UsersController@update');

    $router->delete('/bd/delete', 'AsociadoController@deleteBD');


});

$router->get('/asociados/export/', 'AsociadoController@export');



