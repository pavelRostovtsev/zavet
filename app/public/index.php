<?php

use app\core\Router;

session_start();
error_reporting(E_ALL);
ini_set('display_startup_errors', 1);
ini_set('display_errors', '1');

spl_autoload_register(function ($className)
{
    $path = __DIR__ .DIRECTORY_SEPARATOR . str_replace('\\', '/' , $className ) .'.php';
    $pathToIndex = "app/public/";
    $path = str_replace($pathToIndex,  "",  $path);

    if (file_exists($path)) {
        include_once $path ;
    } else {
        echo 404;
        die;
    }
});

$router = new Router;