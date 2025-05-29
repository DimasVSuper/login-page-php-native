<?php

require_once __DIR__ . '/../model/UserModel.php';

class AuthController
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['register_username'] ?? '';
            $email = $_POST['register_email'] ?? '';
            $password = $_POST['register_password'] ?? '';

            if ($this->userModel->findByUsername($username)) {
                $error = "Username sudah terdaftar!";
            } elseif ($this->userModel->findByEmail($email)) {
                $error = "Email sudah terdaftar!";
            } else {
                $this->userModel->create($username, $email, $password);
                header('Location: /projeklogin/');
                exit;
            }
        }
        require __DIR__ . '/../view/register.view.php';
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['login_username'] ?? '';
            $password = $_POST['login_password'] ?? '';
            $user = $this->userModel->findByUsername($username);

            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user'] = [
                    'id' => $user['id'],
                    'username' => $user['username']
                ];
                header('Location: /projeklogin/main');
                exit;
            } else {
                $error = "Username atau password salah!";
            }
        }
        require __DIR__ . '/../view/login.view.php';
    }

    public function forgot()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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

    public function logout()
    {
        session_destroy();
        header('Location: /projeklogin/');
        exit;
    }

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