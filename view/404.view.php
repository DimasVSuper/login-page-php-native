<?php

?>

<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>404 Not Found</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{
            margin-top:20px;
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
        .error-404 {
            font-size: 7rem;
            font-weight: bold;
            color: #5369f8;
            text-shadow: 2px 2px 8px #fff, 0 0 10px #5369f8;
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
                            <div class="p-5 text-center">
                                <div class="mb-5">
                                    <div class="error-404">404</div>
                                    <h3 class="h4 font-weight-bold text-theme">Oops! Page Not Found</h3>
                                </div>
                                <p class="text-muted mt-2 mb-5">Halaman yang Anda cari tidak ditemukan.<br>Silakan kembali ke halaman utama atau login kembali.</p>
                                <a href="/projeklogin/" class="btn btn-theme">Go to Login</a>
                            </div>
                        </div>
                        <div class="col-lg-6 d-none d-lg-inline-block">
                            <div class="account-block rounded-right">
                                <div class="overlay rounded-right"></div>
                                <div class="account-testimonial">
                                    <h4 class="text-white mb-4">Lost in space?</h4>
                                    <p class="lead text-white">"Sometimes the page you are looking for just isn't there. Let's get you back!"</p>
                                    <p>- Admin User</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end card-body -->
            </div>
            <!-- end card -->
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