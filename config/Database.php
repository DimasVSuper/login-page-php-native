<?php

/**
 * @file config/Database.php
 *
 * File ini mengatur koneksi ke database MySQL menggunakan PDO.
 * Menggunakan singleton pattern untuk memastikan hanya ada satu instance koneksi.
 */

require_once __DIR__ . '/../vendor/autoload.php';

// Load .env jika belum pernah di-load
if (!isset($_ENV['DB_HOST'])) {
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
    $dotenv->load();
}

/**
 * Class Database
 *
 * Mengelola koneksi ke database MySQL menggunakan PDO.
 * Menerapkan singleton pattern untuk memastikan hanya ada satu instance koneksi.
 */
class Database
{
    /**
     * @var PDO|null $instance Instance PDO untuk koneksi database.
     */
    private static $instance = null;

    /**
     * Mendapatkan instance koneksi database.
     *
     * @return PDO Instance PDO untuk koneksi database.
     */
    public static function getConnection()
    {
        if (self::$instance === null) {
            $host = $_ENV['DB_HOST'];
            $dbname = $_ENV['DB_NAME'];
            $user = $_ENV['DB_USER'];
            $pass = $_ENV['DB_PASS'];
            $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";
            self::$instance = new PDO($dsn, $user, $pass, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ]);
        }
        return self::$instance;
    }
}