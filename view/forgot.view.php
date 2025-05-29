<?php
/**
 * @file forgot.view.php
 *
 * Tampilan untuk halaman lupa password.
 * Menampilkan form untuk memasukkan username.
 * Menggunakan Bootstrap untuk styling.
 *
 * @var string $csrf_token Token CSRF untuk melindungi form dari serangan CSRF.
 * @var string $error Pesan error yang ditampilkan jika username tidak ditemukan.
 * @var string $message Pesan sukses yang ditampilkan jika link reset password berhasil dikirim (dummy).
 */
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Forgot Password</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            margin-top: 20px;
            background: #f6f9fc;
        }
        .account-block {
            padding: 0;
            background-image: url(https://bootdey.com/img/Content/bg1.jpg);
            background-repeat: no-repeat;
            background-size: cover;
            height: 100%;
            position: relative;
        }
        .account-block .overlay {
            flex: 1;
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            background-color: rgba(0, 0, 0, 0.4);
        }
        .account-block .account-testimonial {
            text-align: center;
            color: #fff;
            position: absolute;
            margin: 0 auto;
            padding: 0 1.75rem;
            bottom: 3rem;
            left: 0;
            right: 0;
        }
        .text-theme {
            color: #5369f8 !important;
        }
        .btn-theme {
            background-color: #5369f8;
            border-color: #5369f8;
            color: #fff;
        }
    </style>
</head>
<body>
<div id="main-wrapper" class="container">
    <div class="row justify-content-center">
        <div class="col-xl-10">
            <div class="card border-0">
                <div class="card-body p-0">
                    <div class="row no-gutters">
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="mb-5">
                                    <h3 class="h4 font-weight-bold text-theme">Forgot Password</h3>
                                </div>
                                <h6 class="h5 mb-0">Reset your password</h6>
                                <p class="text-muted mt-2 mb-5">Enter your username to receive a password reset link.</p>
                                <?php if (isset($error)): ?>
                                    <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
                                <?php endif; ?>
                                <?php if (isset($message)): ?>
                                    <div class="alert alert-success"><?= htmlspecialchars($message) ?></div>
                                <?php endif; ?>
                                <form method="post" action="">
                                    <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf_token) ?>">
                                    <div class="form-group">
                                        <label for="forgotUsername">Username</label>
                                        <input type="text" class="form-control" id="forgotUsername" name="forgot_username" required>
                                    </div>
                                    <button type="submit" class="btn btn-theme" name="forgot">Send Reset Link</button>
                                </form>
                                <br>
                                <a href="/projeklogin/" class="btn btn-theme">Back to Login</a>
                            </div>
                        </div>
                        <div class="col-lg-6 d-none d-lg-inline-block">
                            <div class="account-block rounded-right">
                                <div class="overlay rounded-right"></div>
                                <div class="account-testimonial">
                                    <h4 class="text-white mb-4">Forgot your password?</h4>
                                    <p class="lead text-white">"No worries, just enter your email and follow the instructions."</p>
                                    <p>- Admin User</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end card-body -->
            </div>
            <!-- end card -->
            <p class="text-muted text-center mt-3 mb-0">
                Remember your password?
                <a href="/projeklogin/" class="text-primary ml-1">Login</a>
            </p>
        </div>
        <!-- end col -->
    </div>
    <!-- Row -->
</div>
<!-- Bootstrap JS and dependencies (for collapse) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>