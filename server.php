<?php
$user = $_POST["user"];
$pass = $_POST["pass"];

// Memastikan input tidak kosong
if (empty($user) || empty($pass)) {
    echo "Username & Password Kosong!!";
    exit;
}

if ($user == "admin") {
    if ($pass == "admin") {
        echo "Berhasil";
    } else {
        echo "Password Salah";
    }
} else {
    echo  "Username atau Password Salah";
}
