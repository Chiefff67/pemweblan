<?php
$servername   = 'localhost'; // atur host
$dbuser   = 'root'; // atur user database
$dbpass   = '';   // atur pass database
$dbname = 'user_management'; // atur nama database

$connect = new mysqli($servername, $dbuser, $dbpass, $dbname);

// Cek koneksi, jika gagal tampilkan pesan error
if ($connect->connect_error) {
    die("Koneksi gagal: " . $connect->connect_error);
}
?>