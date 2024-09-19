<?php
$user = $_POST["user"];
$pass = $_POST["pass"];
if ($user == "admin") {
    if ($pass == "admin") {
        echo "Login Berhasil";
    } else {
        echo "Password Salah";
    }
} else {
    echo  "Username atau Password Salah";
}
