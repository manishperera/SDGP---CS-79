<?php
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
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $rating = $_POST['rating'] ?? 0;
    $suggestions = $_POST['suggestions'] ?? '';
    $improvements = $_POST['improvement'] ?? [];

    $improvements_str = join(', ', $improvements);

    $stmt = $pdo->prepare("INSERT INTO feedback (rating, suggestions, improvements) VALUES (?, ?, ?)");
    $stmt->execute([$rating, $suggestions, $improvements_str]);


    echo "<script>alert('Feedback submitted successfully!'); window.location.href='feedback.php';</script>";

    
}
?>
