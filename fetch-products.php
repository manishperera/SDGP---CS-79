<?php

session_start();

require __DIR__ . '/app/dbConnection.php';

try {

    $stmt = $pdo->query('SELECT name, price, image FROM products');

    while ($row = $stmt->fetch()) {
        echo "<div class='product-item'>";
        echo "<img src='" . htmlspecialchars($row['image']) . "' alt='" . htmlspecialchars($row['name']) . "' style='width:100px; height:auto;'>";
        echo "<div class='product-name'>" . htmlspecialchars($row['name']) . "</div>";
        echo "<div class='product-price'>" . htmlspecialchars($row['price']) . " LKR</div>";
        echo "</div>";
    }
} catch (\PDOException $e) {
    error_log($e->getMessage());
    exit('An error occurred while fetching products.');
}
