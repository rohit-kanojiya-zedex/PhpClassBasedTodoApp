<?php
spl_autoload_register(function ($classname) {
    $classPath = str_replace('\\', DIRECTORY_SEPARATOR, $classname) . '.php';
    $baseDir = __DIR__ . '/../';
    $file = $baseDir . $classPath;
    if (file_exists($file)) {
        require_once $file;
    }
});

