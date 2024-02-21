<?php
session_start();

if (!isset($_SESSION["email"])) {
    http_response_code(403);
    die("Error: You must log in to donate items.");
}

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

$email = $_SESSION["email"];
$stmt = $pdo->prepare("SELECT id FROM sellers WHERE email = :email");
$stmt->execute(['email' => $email]);
$seller_id = $stmt->fetchColumn();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $weight = filter_input(INPUT_POST, 'weight', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $category = filter_input(INPUT_POST, 'category', FILTER_SANITIZE_STRING);
    $image = filter_input(INPUT_POST, 'image', FILTER_SANITIZE_URL);

    $sql = "INSERT INTO donations (name, weight, category, image, seller_id) VALUES (:name, :weight, :category, :image, :seller_id)";
    
    $stmt = $pdo->prepare($sql);

    if ($stmt->execute([
        ':name' => $name,
        ':weight' => $weight,
        ':category' => $category,
        ':image' => $image,
        ':seller_id' => $seller_id
    ])) {
        header("location: add-waste-item.php");
    } else {
        echo "Error: Could not donate item.";
    }
} else {
    http_response_code(405);
    echo "Error: Invalid request method.";
}
?>