<?php

require_once __DIR__ . '/Router.php';
require_once __DIR__ . '/../controller/AuthController.php';

$router = new Router();
$auth = new AuthController();

$router->get('/', [$auth, 'login']);
$router->post('/', [$auth, 'login']); // Tambahkan baris ini!
$router->post('login', [$auth, 'login']);
$router->get('register', [$auth, 'register']);
$router->post('register', [$auth, 'register']);
$router->get('forgot', [$auth, 'forgot']);
$router->post('forgot', [$auth, 'forgot']);
$router->get('logout', [$auth, 'logout']);
$router->get('main', [$auth, 'main']);

$router->dispatch();