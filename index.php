<?php
session_start();

// Session timeout 10 menit (600 detik)
$timeout = 600;
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > $timeout)) {
    session_unset();
    session_destroy();
    header('Location: /projeklogin/');
    exit;
}
$_SESSION['LAST_ACTIVITY'] = time();

require_once 'core/Web.php';