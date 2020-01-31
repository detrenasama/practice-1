<?php

chdir(dirname(__DIR__));

require_once "vendor/autoload.php";

$routes = include "config/routes.php";

$method = $_SERVER['REQUEST_METHOD'];
$path = $_SERVER['REQUEST_URI'];

foreach($routes as $route) {
    if (in_array($method, $route['methods']) && $path === $route['path']) {
        $controller = new $route['controller'];
        $controller->{"action{$route['action']}"}();
        break;
    }
}