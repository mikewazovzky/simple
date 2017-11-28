<?php

namespace MWazovzky\Simple;

use MWazovzky\Simple\Request;

class Router
{
    /**
     * List of existing app routes.
     *
     * @var array $routes
     */
    protected $routes = [];

    /**
     * Default (fallback) route
     *
     * @param array $fallbackRoute ['controller' => $controller, 'action' => $action]
     */
    protected $fallbackRoute;

    /**
     * Load app routes
     *
     * @param array $routes
     */
    public function loadRoutes($routes)
    {
        $this->routes = $routes;
    }

    /**
     * Set default (fallback) route
     *
     * @param type name
     * @return type
     */
    public function loadFallbackRoute($controller, $action)
    {
        $this->fallbackRoute = ['controller' => $controller, 'action' => $action];
    }

    /**
     * Process the request. Hit proper route and provide required parameters
     *
     * @param type name
     * @return type
     */
    public function process(Request $request)
    {
        $route = $this->routes[$request->method][$request->path] ?? $this->fallbackRoute;

        if (!$route) {
            throw new \Exception("Requested route is not defined", 404);
        }

        $controllerName = '\\App\\Controllers\\' . $route['controller'];

        $controller = new $controllerName;

        $controller->action($route['action'], $request->query);
    }
}
