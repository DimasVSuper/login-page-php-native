<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Phroute\Phroute\RouteCollector;
use Phroute\Phroute\Dispatcher;

/**
 * Class Router
 *
 * Kelas untuk mengatur routing aplikasi menggunakan Phroute.
 */
class Router
{
    /**
     * @var RouteCollector $collector Instance RouteCollector dari Phroute.
     */
    private $collector;

    /**
     * Router constructor.
     *
     * Membuat instance RouteCollector untuk mengumpulkan rute.
     */
    public function __construct()
    {
        $this->collector = new RouteCollector();
    }

    /**
     * Menambahkan rute dengan method GET.
     *
     * @param string $route URL rute.
     * @param callable|array $handler Handler yang akan dieksekusi saat rute diakses.
     */
    public function get($route, $handler)
    {
        $this->collector->get($route, $handler);
    }

    /**
     * Menambahkan rute dengan method POST.
     *
     * @param string $route URL rute.
     * @param callable|array $handler Handler yang akan dieksekusi saat rute diakses.
     */
    public function post($route, $handler)
    {
        $this->collector->post($route, $handler);
    }

    /**
     * Menambahkan rute dengan semua method (GET, POST, dll).
     *
     * @param string $route URL rute.
     * @param callable|array $handler Handler yang akan dieksekusi saat rute diakses.
     */
    public function any($route, $handler)
    {
        $this->collector->any($route, $handler);
    }

    /**
     * Menjalankan routing untuk memproses permintaan yang masuk.
     *
     * Membuat instance Dispatcher, mengambil method dan URI dari request,
     * dan menjalankan handler yang sesuai.
     * Menangani exception jika rute tidak ditemukan (404) atau method tidak diizinkan (405).
     */
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