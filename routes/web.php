<?php

/** @var \Laravel\Lumen\Routing\Router $router */



//$router->get('/login', [::class, 'entregar']);
$router->get('/', 'AsociadoController@index');
$router->post('/buscar',  'AsociadoController@buscar');
//$router->get('/asociado/{asociado}', [AsociadoController::class, 'asociado']);
//$router->post('/entregar/{asociado}', [AsociadoController::class, 'entregar']);
