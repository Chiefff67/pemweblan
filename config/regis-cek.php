<?php
// Include koneksi ke database
include("koneksi.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // Debugging untuk memastikan data diterima
    // if (empty($name) || empty($username) || empty($password)) {
    //     echo "Kolom yang dikirim: Nama = $name, Username = $username, Password = $password";
    //     exit;
    // }

    // Validasi input (Cek apakah ada kolom yang kosong)
    if (empty($name) || empty($username) || empty($password)) {
        echo "Semua kolom harus diisi!";
        exit;
    }

    // Cek apakah username sudah terdaftar
    $stmt = $connect->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Jika username sudah terdaftar
        echo "Username sudah digunakan!";
    } else {
        // Enkripsi password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Simpan data ke database
        $stmt = $connect->prepare("INSERT INTO users (name, username, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $username, $hashed_password);

        if ($stmt->execute()) {
            // Jika registrasi berhasil
            echo "Berhasil";
        } else {
            // Jika terjadi kesalahan saat menyimpan data
            echo "Gagal mendaftar. Silakan coba lagi.";
        }
    }

    // Tutup statement dan koneksi
    $stmt->close();
    $connect->close();
}
