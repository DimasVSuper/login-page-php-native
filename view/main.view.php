<?php
/**
 * @file main.view.php
 *
 * Tampilan halaman utama setelah pengguna berhasil login.
 * Menampilkan pesan selamat datang dan tombol logout.
 * Dilengkapi dengan script JavaScript untuk mendeteksi aktivitas pengguna
 * dan melakukan logout otomatis jika tidak ada aktivitas selama periode waktu tertentu.
 *
 * @var string $username Nama pengguna yang sedang login.
 */
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
<script>
/**
 * @const AFK_LIMIT Batas waktu tidak aktif (AFK) dalam milidetik sebelum pengguna otomatis logout.
 * Nilai default adalah 600000 (10 menit). Ubah menjadi 60000 untuk 1 menit (testing).
 */
const AFK_LIMIT = 600000; // 10 menit = 600000 ms (ganti 60000 untuk 1 menit)

/**
 * @var afkTimer Timer untuk menghitung waktu tidak aktif pengguna.
 */
let afkTimer;

/**
 * Fungsi untuk mereset timer AFK.
 * Setiap kali ada aktivitas pengguna, timer akan direset.
 */
function resetAfkTimer() {
    clearTimeout(afkTimer);
    afkTimer = setTimeout(() => {
        alert('Session telah habis, direct ke login');
        window.location.href = '/projeklogin/logout';
    }, AFK_LIMIT);
}

/**
 * Menambahkan event listener ke dokumen untuk mendeteksi aktivitas pengguna.
 * Setiap kali salah satu event ini terjadi, fungsi resetAfkTimer akan dipanggil.
 */
['mousemove', 'keydown', 'mousedown', 'touchstart'].forEach(evt => {
    document.addEventListener(evt, resetAfkTimer, false);
});

/**
 * Memulai timer AFK saat halaman dimuat.
 */
resetAfkTimer();
</script>
</html>