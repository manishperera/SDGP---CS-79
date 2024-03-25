<?php

session_start();

require __DIR__ . '/app/dbConnection.php';

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
