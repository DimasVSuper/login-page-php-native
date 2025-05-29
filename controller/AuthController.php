<?php

/**
 * @file AuthController.php
 *
 * Controller untuk menangani proses autentikasi pengguna.
 * Berisi fungsi-fungsi untuk registrasi, login, forgot password, logout, dan halaman utama.
 */

require_once __DIR__ . '/../model/UserModel.php';

/**
 * Class AuthController
 *
 * Mengelola logika autentikasi pengguna.
 */
class AuthController
{
    /**
     * @var UserModel $userModel Instance UserModel untuk berinteraksi dengan data pengguna.
     */
    private $userModel;

    /**
     * AuthController constructor.
     *
     * Membuat instance UserModel.
     */
    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    /**
     * Menangani proses registrasi pengguna.
     *
     * @return void
     */
    public function register()
    {
        // Generate CSRF token
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        $csrf_token = $_SESSION['csrf_token'];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Validate CSRF token
            if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $csrf_token) {
                die('CSRF token mismatch!');
            }
            $username = $_POST['register_username'] ?? '';
            $email = $_POST['register_email'] ?? '';
            $password = $_POST['register_password'] ?? '';

            if ($this->userModel->findByUsername($username)) {
                $error = "Username sudah terdaftar!";
            } elseif ($this->userModel->findByEmail($email)) {
                $error = "Email sudah terdaftar!";
            } else {
                $this->userModel->create($username, $email, $password);
                unset($_SESSION['csrf_token']);
                header('Location: /projeklogin/');
                exit;
            }
        }
        require __DIR__ . '/../view/register.view.php';
    }

    /**
     * Menangani proses login pengguna.
     *
     * @return void
     */
    public function login()
    {
        // Generate CSRF token
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        $csrf_token = $_SESSION['csrf_token'];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Validate CSRF token
            if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $csrf_token) {
                die('CSRF token mismatch!');
            }
            $username = $_POST['login_username'] ?? '';
            $password = $_POST['login_password'] ?? '';
            $user = $this->userModel->findByUsername($username);

            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user'] = [
                    'id' => $user['id'],
                    'username' => $user['username']
                ];
                unset($_SESSION['csrf_token']);
                header('Location: /projeklogin/main');
                exit;
            } else {
                $error = "Username atau password salah!";
            }
        }
        require __DIR__ . '/../view/login.view.php';
    }

    /**
     * Menangani proses forgot password (dummy).
     *
     * @return void
     */
    public function forgot()
    {
        // Generate CSRF token
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        $csrf_token = $_SESSION['csrf_token'];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Validate CSRF token
            if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $csrf_token) {
                die('CSRF token mismatch!');
            }
            $email = $_POST['forgot_email'] ?? '';
            $user = $this->userModel->findByEmail($email);

            if ($user) {
                $message = "Link reset password telah dikirim ke email Anda (dummy).";
            } else {
                $error = "Email tidak ditemukan!";
            }
        }
        require __DIR__ . '/../view/forgot.view.php';
    }

    /**
     * Menangani proses logout pengguna.
     *
     * @return void
     */
    public function logout()
    {
        session_destroy();
        header('Location: /projeklogin/');
        exit;
    }

    /**
     * Menangani tampilan halaman utama setelah login.
     *
     * @return void
     */
    public function main()
    {
        if (!isset($_SESSION['user'])) {
            header('Location: /projeklogin/');
            exit;
        }
        $username = $_SESSION['user']['username'];
        require __DIR__ . '/../view/main.view.php';
    }
}