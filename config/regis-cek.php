<?php
// Include koneksi ke database
include("koneksi.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // Validasi input (Cek apakah ada kolom yang kosong)
    if (empty($name) || empty($username) || empty($password)) {
        echo "Semua kolom harus diisi!";
        exit;
    }

    // Cek apakah username sudah terdaftar
    $stmt = $connectdb->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $result = $stmt->fetch();

    if ($result) {
        // Jika username sudah terdaftar
        echo "Username sudah digunakan!";
    } else {
        // Enkripsi password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Simpan data ke database
        $stmt = $connectdb->prepare("INSERT INTO users (name, username, password) VALUES (?, ?, ?)");

        if ($stmt->execute([$name, $username, $hashed_password])) {
            // Jika registrasi berhasil
            echo "Berhasil";
        } else {
            // Jika terjadi kesalahan saat menyimpan data
            echo "Gagal mendaftar. Silakan coba lagi.";
        }
    }
}
?>