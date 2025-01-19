<?php
// punto de entrada del servidor
const BASE_PATH = __DIR__;

header('Content-Type: application/json');
require_once BASE_PATH . '/autoload.php';
require_once BASE_PATH . '/app/route_manager.php';