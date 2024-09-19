<?php
$host   = 'localhost'; // atur host
$user   = 'root'; // atur user database
$pass   = '';   // atur pass database
$dbname = 'user_management'; // atur nama database

// Buat Koneksinya
$connectdb = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
?>