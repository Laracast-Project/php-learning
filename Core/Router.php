<?php

namespace Core;

class Router{
    protected $routes = [];

    public function add($uri, $controller, $method)
    {
        $this->routes[] = [
            'uri' => $uri,
            'controller' => $controller,
            'method' => $method
        ];

    }

    public function get($uri, $controller)
    {
        $this->add($uri, $controller, 'GET');
        
    }

    public function post($uri, $controller)
    {
        $this->add($uri, $controller, 'POST');
    }

    public function delete($uri, $controller)
    {
        $this->add($uri, $controller, 'DELETE');
    }

    public function patch($uri, $controller)
    {
        $this->add($uri, $controller, 'PATCH');
    }

    public function put($uri, $controller)
    {
        $this->add($uri, $controller, 'PUT');
    }

    public function route($uri, $method)
    {
        foreach ($this->routes as $route){
            if ($route['uri'] === $uri && $route['method'] === strtoupper($method)){
                return require base_path($route['controller']);
            }
        }

        $this->abort();
    }

    protected function abort($code = 404) {
        http_response_code($code);

        require base_path("views/{$code}.php");

        die();
    }
}

