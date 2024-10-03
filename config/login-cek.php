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
$stmt = $connect->prepare("SELECT * FROM users WHERE username = ?");
$stmt->bind_param("s", $usr);  // Bind parameter 's' (string) untuk username
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_object();

// Cek apakah user ditemukan dan password cocok
if ($row && password_verify($pss, $row->password)) {
    session_start();
    // Karena tidak ada id_user, kita simpan username sebagai identifier di session
    $_SESSION['U'] = $row->username;

    echo "Berhasil";
} else {
    echo "Username atau Password Salah";
}

$stmt->close();
$connect->close();
