<?php
/**
 * Load php classes
 */
require_once __DIR__.'/vendor/autoload.php';

/**
 * Load routes
 */
use App\Core\Router;
$router = new Router;
$router->run();