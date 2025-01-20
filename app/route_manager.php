<?php

// es el archivo mas 'complicado' por lo que dejo varios comentarios
// Aca se se manejan las rutas y metodos del archivo routes para redireccionar las peticiones

global $routes;
require_once BASE_PATH . '/app/routes.php';

$precioUsd = getenv('PRECIO_USD');

if (!$precioUsd) {
    http_response_code(500);
    echo json_encode(['error' => 'PRECIO_USD no está configurado']);
    exit;
}

// Función para convertir rutas con `{param}` en expresiones regulares
function convertRouteToRegex(string $route): string
{
    return '#^' . preg_replace('#\{[^/]+\}#', '([^/]+)', $route) . '$#';
}

$uri = rtrim(urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)), '/');
$method = $_SERVER['REQUEST_METHOD'];

foreach ($routes as $route => $actions) { //recorro las rutas
    // Si la ruta contiene `{` es porque declarada en route como ruta dinamica
    if (strpos($route, '{') !== false) {
        $regex = convertRouteToRegex($route);
    } else {
        $regex = '#^' . $route . '$#';
    }
    if (preg_match($regex, $uri, $matches)) { // valido que la ruta ingresada sea esperada en $routes y capturo la parte dinamica (por ej {id}) en matches
        if (isset($actions[$method])) { // Corroboro que el metodo de la peticion sea valido
            array_shift($matches); // remuevo el primer elemento del array matches que es la ruta principal (/productos)
            $action = explode('@', $actions[$method]); // separo controller y metodo
            $controller = new $action[0]();
            call_user_func_array([$controller, $action[1]], $matches); // callback al controller
            exit;
        }
    }
}
http_response_code(404);
echo json_encode(['error' => 'Ruta no encontrada']);

