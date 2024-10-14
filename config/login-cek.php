<?php
include("koneksi.php");

// Ambil input dari form dan lakukan validasi
$usr = $_POST['user'] ?? '';
$pss = $_POST['pass'] ?? '';

if (empty($usr) || empty($pss)) {
    echo "Semua kolom harus diisi!";
    exit;
}

// Query SQL dengan prepared statement
$stmt = $connectdb->prepare("SELECT * FROM users WHERE username = ?");
$stmt->execute([$usr]);
$row = $stmt->fetch();

// Cek apakah user ditemukan dan password cocok
if ($row && password_verify($pss, $row['password'])) {
    session_start();
    $_SESSION['U'] = $row['username'];
    echo "Berhasil";
} else {
    echo "Username atau Password Salah";
}
?>