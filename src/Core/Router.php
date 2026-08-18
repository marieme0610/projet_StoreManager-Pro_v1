<?php

class Router {
    
    private array $routes;

    public function __construct(array $routes) {
        $this->routes = $routes;
    }

    public function route() {
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $uri = '/' . trim($uri, '/');

        if (isset($this->routes[$uri])) {
            $route = $this->routes[$uri];
            $route['controller']->{$route['action']}();
        } else {
            http_response_code(404);
            echo "Route inexistante : $uri";
        }
    }
}


