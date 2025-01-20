<?php
// punto de entrada del servidor
const BASE_PATH = __DIR__;

//para que funcionen las peticiones desde cualquier origen.
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

// preflight
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

require_once BASE_PATH . '/autoload.php';
require_once BASE_PATH . '/app/route_manager.php';