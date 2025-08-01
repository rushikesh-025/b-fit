<?php
$host = 'sql12.freesqldatabase.com';     // e.g., gttzi2v86p...xyz.render.com
$db   = 'sql12792959';              // e.g., bfit_db
$user = 'sql12792959';          // e.g., root
$pass = 'Gttzi2v86p';          // paste the password you just got
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
     $pdo = new PDO($dsn, $user, $pass, $options);
     // echo "Connected successfully"; // Optional for testing
} catch (\PDOException $e) {
     die("Connection failed: " . $e->getMessage());
}
?>
