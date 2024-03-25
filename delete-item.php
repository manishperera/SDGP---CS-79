<?php

session_start();

require __DIR__ . '/app/dbConnection.php';

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

try {
    $stmt = $pdo->prepare("DELETE FROM waste WHERE id = :id");
    $stmt->execute(['id' => $id]);

    echo "Item deleted successfully!";
} catch (\PDOException $e) {
    error_log($e->getMessage());
    exit("An error occurred while deleting the item.");
}
