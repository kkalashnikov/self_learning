<?php

 spl_autoload_register(function ($class_name) {
    $file = __DIR__ . '\\src\\' . $class_name . '.php';
    $file = str_replace('\\', DIRECTORY_SEPARATOR, $file);
    if (file_exists($file)) {
        require_once $file;
    }
});

?>