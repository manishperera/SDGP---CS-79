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

$stmt = $pdo->query('SELECT name, price, image FROM products');

while ($row = $stmt->fetch())
{
    echo "<div class='product-item'>";
    echo "<img src='" . htmlspecialchars($row['image']) . "' alt='" . htmlspecialchars($row['name']) . "' style='width:100px; height:auto;'>";
    echo "<div class='product-name'>" . htmlspecialchars($row['name']) . "</div>";
    echo "<div class='product-price'>" . htmlspecialchars($row['price']) . " LKR</div>";
    echo "</div>";
}
?>
