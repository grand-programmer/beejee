<?php

namespace App\Core;

/**
 * Class Router
 * @package App\Core
 */
class Router {

    /**
     * @var array
     */
    protected $routes = [];

    /**
     * @var array
     */
    protected $currentRoute = [];

    /**
     * @var string
     */
    protected $params = '';

    /**
     * Router constructor.
     */
    public function __construct() {

        $arr = require 'app/config/routes.php';
        foreach ($arr as $key => $val) {
            $this->add($key, $val);
        }
    }

    /**
     * Add routes
     *
     * @param $route
     * @param $currentRoute
     */
    public function add($route, $currentRoute) {
        $route = '#^'.$route.'$#';
        $this->routes[$route] = $currentRoute;
    }

    /**
     * Check route name
     *
     * @return bool
     */
    public function match() {

        $url = trim(preg_replace('#\?.*$#', '', trim($_SERVER['REQUEST_URI'], '/')),'/');
        foreach ($this->routes as $route => $currentRoute) {
            if (preg_match($route, $url, $matches)) {
                $this->currentRoute = $currentRoute;
                return true;
            }
        }
        return false;
    }

    /**
     * Load routes
     */
    public function run(){
        if ($this->match()) {
            $path = 'App\Controllers\\'.ucfirst($this->currentRoute['controller']).'Controller';
            if (class_exists($path)) {
                $action = $this->currentRoute['action'];
                if (method_exists($path, $action)) {
                    $this->loadParams();
                    $controller = new $path($this->currentRoute);
                    $controller->$action($this->params);
                } else {
                    View::errorCode(404);
                }
            } else {
                View::errorCode(404);
            }
        } else {
            View::errorCode(404);
        }
    }

    /**
     * Load params
     */
    private function loadParams() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST)) {
            $this->params = $_POST;
        }

        if ($_SERVER['REQUEST_METHOD'] == 'GET' && !empty($_GET)) {
            $this->params = $_GET;
        }
    }

}