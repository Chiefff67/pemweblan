<?php
// Sertakan file koneksi database
include("koneksi.php");

// Query untuk mengambil data user
$query = "SELECT username, password, name FROM users";
$result = $connect->query($query);

// Periksa apakah query berhasil dijalankan
if ($result->num_rows > 0) {
    $data = array();

    // Ambil setiap baris hasil dan masukkan ke dalam array
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    // Ubah data menjadi format JSON dan kirim sebagai respons
    echo json_encode($data);
} else {
    // Jika tidak ada data yang ditemukan
    echo json_encode([]);
}

// Tutup koneksi
$connect->close();
?>