<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Phroute\Phroute\RouteCollector;
use Phroute\Phroute\Dispatcher;

class Router
{
    private $collector;

    public function __construct()
    {
        $this->collector = new RouteCollector();
    }

    public function get($route, $handler)
    {
        $this->collector->get($route, $handler);
    }

    public function post($route, $handler)
    {
        $this->collector->post($route, $handler);
    }

    public function any($route, $handler)
    {
        $this->collector->any($route, $handler);
    }

    public function dispatch()
    {
        $dispatcher = new Dispatcher($this->collector->getData());

        $httpMethod = $_SERVER['REQUEST_METHOD'];
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        // Hilangkan base path jika perlu (misal: /projeklogin/)
        $basePath = '/projeklogin/';
        if (strpos($uri, $basePath) === 0) {
            $uri = substr($uri, strlen($basePath));
        }

    try {
        echo $dispatcher->dispatch($httpMethod, $uri);
    } catch (\Phroute\Phroute\Exception\HttpRouteNotFoundException $e) {
        http_response_code(404);
        require __DIR__ . '/../view/404.view.php';
    } catch (\Phroute\Phroute\Exception\HttpMethodNotAllowedException $e) {
        http_response_code(405);
        echo "405 Method Not Allowed";
    }
    }
}