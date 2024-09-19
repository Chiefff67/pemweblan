<?php
// $user = $_POST["user"];
// $pass = $_POST["pass"];

// Memastikan input tidak kosong
// if (empty($user) || empty($pass)) {
//     echo "Username & Password Kosong!!";
//     exit;
// }

// if ($user == "admin") {
//     if ($pass == "admin") {
//         echo "Berhasil";
//     } else {
//         echo "Password Salah";
//     }
// } else {
//     echo  "Username atau Password Salah";
// }

    require 'koneksi.php'; 
    require 'Datatables.php';
    $dataTables = new Datatables();

    // mengambil data dari database
    // sql query
    $query = "SELECT * FROM users";
    // $where  = array('nama_kategori' => 'Tutorial');
    $where  = null; 
    // jika memakai IS NULL pada where sql
    $isWhere = null;
    // $isWhere = 'artikel.deleted_at IS NULL';
    $search = array('username','password','name');
    echo $dataTables->getQuery($connectdb, $query, $where, $isWhere, $search);
?>
