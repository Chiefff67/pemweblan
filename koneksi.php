<?php
$servername   = 'localhost'; // atur host
$dbuse   = 'root'; // atur user database
$dbpassword   = '';   // atur pass database
$dbname = 'user_management'; // atur nama database

$connect = mysqli_connect($servername, $dbuser, $dbpassword);

$connect_error = "koneksi gagal atau database tidak ada";
mysqli_select_db($connect, $dbname) or die($connect_error);
?>
