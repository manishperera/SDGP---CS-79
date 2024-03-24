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
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $upload_dir = 'uploads/';
        $uploaded_file = $upload_dir . basename($_FILES['image']['name']);
        
        if (move_uploaded_file($_FILES['image']['tmp_name'], $uploaded_file)) {
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
        } else {
            echo "There was an error uploading the file.";
        }
    }
}
?>
