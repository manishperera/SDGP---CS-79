<?php

session_start();

if (!isset($_SESSION["email"])) {
    http_response_code(403);
    exit("Unauthorized");
}

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    http_response_code(405);
    exit("Method Not Allowed");
}

if (!isset($_POST["id"])) {
    http_response_code(400);
    exit("Bad Request");
}

$id = $_POST["id"];

$host = 'localhost';
$db   = 'zerowaste';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

$stmt = $pdo->prepare("DELETE FROM waste WHERE id = :id");
$stmt->execute(['id' => $id]);

echo "Item deleted successfully!";
