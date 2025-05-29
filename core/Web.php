<?php

/**
 * @file core/Web.php
 *
 * File ini mengatur routing aplikasi web menggunakan Phroute.
 * Mendefinisikan rute untuk halaman login, register, forgot password, logout, dan main.
 */

require_once __DIR__ . '/Router.php';
require_once __DIR__ . '/../controller/AuthController.php';

/**
 * Membuat instance Router untuk mengatur routing.
 */
$router = new Router();

/**
 * Membuat instance AuthController untuk menangani logika autentikasi.
 */
$auth = new AuthController();

/**
 * Mendefinisikan rute-rute aplikasi.
 * Setiap rute menghubungkan URL dengan method yang sesuai di AuthController.
 */
$router->get('/', [$auth, 'login']);
$router->post('/', [$auth, 'login']); // Tambahkan baris ini!
$router->post('login', [$auth, 'login']);
$router->get('register', [$auth, 'register']);
$router->post('register', [$auth, 'register']);
$router->get('forgot', [$auth, 'forgot']);
$router->post('forgot', [$auth, 'forgot']);
$router->get('logout', [$auth, 'logout']);
$router->get('main', [$auth, 'main']);

/**
 * Menjalankan routing untuk memproses permintaan yang masuk.
 */
$router->dispatch();