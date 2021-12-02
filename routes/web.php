<?php

/** @var \Laravel\Lumen\Routing\Router $router */

$router->get('/', 'AsociadoController@index');
$router->post('/login', 'AuthController@login');

$router->group(['middleware' => 'auth'], function () use ($router) {

    $router->get('user', 'AuthController@user');

    $router->post('/buscar', 'AsociadoController@buscar');
    $router->get('/asociado/{asociado}', 'AsociadoController@asociado');
    $router->post('/entregar/{asociado}', 'AsociadoController@entregar');
    $router->post('/logout', 'AuthController@logout');
});
