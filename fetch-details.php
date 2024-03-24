<?php

$host = 'localhost';
$db = 'zerowaste';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    try {
        $stmt = $pdo->prepare('SELECT * FROM waste_factories WHERE id = ?');
        $stmt->execute([$id]);
        $factory = $stmt->fetch();

        if ($factory) {
            echo '<p><strong>Name:</strong> ' . htmlspecialchars($factory['name']) . '</p>';
            echo '<p><strong>Details:</strong> ' . htmlspecialchars($factory['details']) . '</p>';
            echo '<p><strong>Contact:</strong> ' . htmlspecialchars($factory['contact']) . '</p>';
            echo '<p><strong>Efficiency:</strong> ' . htmlspecialchars($factory['efficiency']) . '%</p>';
        } else {
            echo '<p>Factory details not found.</p>';
        }
    } catch (PDOException $e) {
        echo 'Query failed: ' . $e->getMessage();
    }
}
?>
