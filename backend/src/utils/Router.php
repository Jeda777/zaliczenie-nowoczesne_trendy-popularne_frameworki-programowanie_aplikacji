<?php

class Router {
    private $routes = [];

    public function addRoute(string $method, string $path, callable $callback) {
        $this->routes[] = [
            'method' => $method,
            'path' => $path,
            'callback' => $callback
        ];
    }

    public function dispatch(string $uri, string $method) {
        $found = false;

        foreach ($this->routes as $route) {
            $pattern = preg_replace('/\//', '\\/', $route['path']);
            $pattern = '/^' . $pattern . '$/';

            if ($route['method'] === $method && preg_match($pattern, $uri, $matches)) {
                $found = true;
                array_shift($matches);

                call_user_func_array($route['callback'], $matches);
                break;
            }
        }

        if (!$found) {
            http_response_code(404);
            echo json_encode(['message' => 'Not Found']);
        }
    }
}

?>