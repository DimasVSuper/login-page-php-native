<?php
/**
 * @file index.php
 *
 * Titik masuk utama aplikasi.
 * Mengelola inisialisasi dan batas waktu session, kemudian menyertakan router web.
 */

session_start();

/**
 * @var int $timeout Batas waktu session dalam detik (default: 600 detik = 10 menit).
 */
$timeout = 600;

/**
 * Periksa apakah session tidak aktif lebih lama dari batas waktu.
 * Jika ya, hapus session dan alihkan ke halaman login.
 */
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > $timeout)) {
    session_unset();
    session_destroy();
    header('Location: /projeklogin/');
    exit;
}

/**
 * Perbarui timestamp aktivitas terakhir dalam session.
 */
$_SESSION['LAST_ACTIVITY'] = time();

/**
 * Sertakan router web untuk menangani permintaan yang masuk.
 */
require_once 'core/Web.php';