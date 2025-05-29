<?php

?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Halaman Utama</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{margin-top:20px;background: #f6f9fc;}
        .header-bar {
            background: #5369f8;
            color: #fff;
            padding: 1rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
    </style>
</head>
<body>
    <div class="header-bar">
        <div>Hallo, <b><?= htmlspecialchars($username) ?></b></div>
        <a href="/projeklogin/logout" class="btn btn-light btn-sm">Logout</a>
    </div>
    <div class="container mt-5">
        <h2>Selamat datang di halaman utama!</h2>
        <p>Anda berhasil login sebagai <b><?= htmlspecialchars($username) ?></b>.</p>
    </div>
</body>
</html>