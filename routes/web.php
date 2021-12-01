<?php

/** @var \Laravel\Lumen\Routing\Router $router */

$router->get('/', 'AuthController@index');
$router->post('/login', 'AuthController@index');

$router->get('/inicio', 'AsociadoController@index');
$router->post('/buscar',  'AsociadoController@buscar');
$router->get('/asociado/{asociado}', 'AsociadoController@asociado');
$router->post('/entregar/{asociado}', 'AsociadoController@entregar');
