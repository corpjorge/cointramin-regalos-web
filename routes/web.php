<?php

/** @var \Laravel\Lumen\Routing\Router $router */

//$router->get('/login', 'AsociadoController@entregar');
$router->get('/', 'AsociadoController@index');
$router->post('/buscar',  'AsociadoController@buscar');
$router->get('/asociado/{asociado}', 'AsociadoController@asociado');
$router->post('/entregar/{asociado}', 'AsociadoController@entregar');
