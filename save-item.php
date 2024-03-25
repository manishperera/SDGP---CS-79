<?php

session_start();

require __DIR__ . '/app/dbConnection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $upload_dir = 'uploads/';
        $uploaded_file = $upload_dir . basename($_FILES['image']['name']);

        if (move_uploaded_file($_FILES['image']['tmp_name'], $uploaded_file)) {
            try {
                $stmt = $pdo->prepare("INSERT INTO items (name, address, contact, quantity, price, image_path) VALUES (?, ?, ?, ?, ?, ?)");
                $stmt->execute([
                    $_POST['name'],
                    $_POST['address'],
                    $_POST['contact'],
                    $_POST['quantity'],
                    $_POST['price'],
                    $uploaded_file
                ]);

                echo "Item added successfully!";
            } catch (\PDOException $e) {
                error_log($e->getMessage());
                echo "An error occurred while adding the item.";
            }
        } else {
            echo "There was an error uploading the file.";
        }
    }
}
