# Projek Login PHP Sederhana

Aplikasi login, register, dan forgot password berbasis PHP, MySQL, dan Phroute, dengan session timeout, UUID, serta struktur MVC sederhana.  
Cocok untuk belajar konsep login modern dan best practice PHP.

[![PHP](https://img.shields.io/badge/PHP-8%2B-blue?logo=php)](https://www.php.net/releases/8.0/en.php)
[![Bootstrap](https://img.shields.io/badge/Bootstrap-4.5-blueviolet?logo=bootstrap)](https://getbootstrap.com/docs/4.5/getting-started/introduction/)
[![MySQL](https://img.shields.io/badge/MySQL-Database-orange?logo=mysql)](https://www.mysql.com/)
[![XAMPP](https://img.shields.io/badge/XAMPP-Server-orange?logo=apache)](https://www.apachefriends.org/)
[![Phroute Routing](https://img.shields.io/badge/Phroute-Routing-lightgrey?logo=github)](https://github.com/mrjgreen/phroute)
[![PHP Dotenv](https://img.shields.io/badge/PHP--Dotenv-Config-green?logo=github)](https://github.com/vlucas/phpdotenv)
[![Password Hashing](https://img.shields.io/badge/PHP-Password--Hashing-yellow?logo=php)](https://www.php.net/manual/en/function.password-hash.php)

---

## Fitur

- **Register** dengan username, email, dan password (password di-hash, id UUID otomatis MySQL)
- **Login** dengan session, redirect ke halaman utama (main)
- **Logout** (hapus session)
- **Session timeout** otomatis logout jika AFK 10 menit
- **Forgot password** (gimmick, tidak benar-benar kirim email)
- **Routing** menggunakan [Phroute](https://github.com/mrjgreen/phroute)
- **Konfigurasi** menggunakan file `.env` (via [vlucas/phpdotenv](https://github.com/vlucas/phpdotenv))
- **Struktur folder rapi**: config, core, controller, model, view
- **Proteksi .htaccess** dan URL rewriting

---


## Instalasi

### 1. **Clone/Download Project**

Letakkan di folder `htdocs` XAMPP, misal:  
`c:\xampp\htdocs\projeklogin`

### 2. **Install Dependency Composer**

Buka terminal di folder projek, jalankan:
```sh
composer install
```
Akan menginstall:
- phroute/phroute
- vlucas/phpdotenv

### 3. **Buat Database MySQL**

Login ke phpMyAdmin atau MySQL CLI, jalankan:

```sql
CREATE DATABASE projeklogin CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE projeklogin;

CREATE TABLE users (
    id CHAR(36) PRIMARY KEY DEFAULT (UUID()),
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

### 4. **Buat File .env**

Isi file `.env` di root projek:

```
DB_HOST=localhost
DB_NAME=(Sesuaikan nama database Anda, misal: projeklogin)
DB_USER=(sesuaikan username MySQL Anda, misal: root)
DB_PASS=(sesuaikan password MySQL Anda, misal: kosongkan jika tidak ada)
```

**(Jika password MySQL Anda berbeda, sesuaikan `DB_PASS`)**

---

## Konfigurasi Apache

### 5. **.htaccess**

Pastikan file `.htaccess` di root projek seperti berikut:

```
# Aktifkan mod_rewrite
RewriteEngine On

# Pastikan base path sesuai folder projek (jika di subfolder)
RewriteBase /projeklogin/

# Hilangkan .php di URL (opsional)
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^ index.php [QSA,L]

# Blokir akses ke file sensitif
<FilesMatch "\.(htaccess|env|git|ini|log|sh|bak)$">
  Order allow,deny
  Deny from all
</FilesMatch>

# Atur default index file
DirectoryIndex index.php index.html

# Nonaktifkan directory listing
Options -Indexes
```

**Restart Apache** setelah mengubah `.htaccess`.

---

## Cara Menjalankan

1. **Jalankan XAMPP** (Apache & MySQL)
2. **Akses di browser:**  
   ```
   http://localhost/projeklogin/
   ```
3. **Register user baru**, lalu login.
4. Setelah login, akan diarahkan ke halaman utama (`main.view.php`) dengan tulisan "Hallo, username" dan tombol Logout.
5. Jika AFK 10 menit, session otomatis logout dan redirect ke halaman login.

---

## Penjelasan Fitur

### Register

- Form register: username, email, password.
- Password di-hash dengan `password_hash()`.
- ID user otomatis UUID (MySQL, bukan PHP).
- Jika username/email sudah ada, tampil pesan error.

### Login

- Form login: username, password.
- Jika benar, session `$_SESSION['user']` di-set.
- Redirect ke `/main`.
- Jika salah, tampil pesan error.

### Main Page

- Hanya bisa diakses jika sudah login.
- Tampil: "Hallo, username" dan tombol Logout.
- Jika session expired (AFK 10 menit), otomatis logout.

### Logout

- Menghapus session, redirect ke halaman login.

### Forgot Password

- Form input email (atau username, sesuai view).
- Tidak benar-benar mengirim email (gimmick).
- Tampil pesan "Link reset password telah dikirim ke email Anda (dummy)."

---

## Referensi

- [Phroute Routing](https://github.com/mrjgreen/phroute)
- [PHP Dotenv](https://github.com/vlucas/phpdotenv)
- [PHP Password Hashing](https://www.php.net/manual/en/function.password-hash.php)
- [Bootstrap 4](https://getbootstrap.com/docs/4.5/getting-started/introduction/)

---

**Lanjut** untuk penjelasan kode, troubleshooting, dan pengembangan lebih lanjut.