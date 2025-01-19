<?php

// Autoload de los controladores
spl_autoload_register(function ($class) {
    $file = BASE_PATH . '/app/controllers/'. $class . '.php';
    if (file_exists($file)) {
        require_once $file;
    }
});
