<?php

/**
 * @file UserModel.php
 *
 * Model untuk mengelola data pengguna.
 * Berisi fungsi-fungsi untuk berinteraksi dengan tabel `users` di database.
 */

require_once __DIR__ . '/../config/Database.php';

/**
 * Class UserModel
 *
 * Menyediakan fungsi untuk mencari, membuat, dan memvalidasi data pengguna.
 */
class UserModel
{
    /**
     * @var PDO $pdo Instance PDO untuk koneksi database.
     */
    private $pdo;

    /**
     * UserModel constructor.
     *
     * Membuat instance PDO menggunakan koneksi dari class Database.
     */
    public function __construct()
    {
        $this->pdo = Database::getConnection();
    }

    /**
     * Mencari pengguna berdasarkan username.
     *
     * @param string $username Username pengguna yang dicari.
     *
     * @return array|false Data pengguna dalam bentuk array asosiatif jika ditemukan, false jika tidak.
     */
    public function findByUsername($username)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Mencari pengguna berdasarkan email.
     *
     * @param string $email Email pengguna yang dicari.
     *
     * @return array|false Data pengguna dalam bentuk array asosiatif jika ditemukan, false jika tidak.
     */
    public function findByEmail($email)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Membuat pengguna baru.
     *
     * @param string $username Username pengguna baru.
     * @param string $email Email pengguna baru.
     * @param string $password Password pengguna baru (akan di-hash sebelum disimpan).
     *
     * @return bool True jika pembuatan berhasil, false jika gagal.
     */
    public function create($username, $email, $password)
    {
        $hash = password_hash($password, PASSWORD_BCRYPT);
        $stmt = $this->pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        return $stmt->execute([$username, $email, $hash]);
    }
}