<?php
$host   = 'localhost'; // atur host
$user   = 'root'; // atur user database
$pass   = '';   // atur pass database
$db    = 'user_management'; // atur nama database
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $connectdb = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    // Hanya log error, jangan tampilkan ke user
    error_log("Connection failed: " . $e->getMessage());
    die(json_encode(['error' => 'Database connection failed']));
}
?>
