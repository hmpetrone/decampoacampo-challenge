<?php
// aca declaro todas las rutas que se usaran en el proyecto
$routes = [
    '/productos' => [
        'GET' => 'ProductController@index',
        'POST' => 'ProductController@create',
    ],
    '/productos/{id}' => [
        'GET' => 'ProductController@show',
        'PUT' => 'ProductController@update',
        'DELETE' => 'ProductController@delete',
    ],
];