<?php

use Zend\ServiceManager\ServiceManager;

chdir(dirname(__DIR__));

require_once "vendor/autoload.php";

session_start();

$serviceManager = new ServiceManager(include("config/config.php"));

$method = $_SERVER['REQUEST_METHOD'];
$path = $_SERVER['REQUEST_URI'];

$routes = include "config/routes.php";
foreach($routes as $route) {
    if (in_array($method, $route['methods']) && $path === $route['path']) {
        $controller = $serviceManager->get($route['controller']);
        $controller->{"action{$route['action']}"}();
        break;
    }
}