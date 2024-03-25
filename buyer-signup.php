<?php

session_start();

require __DIR__ . '/app/dbConnection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $user_name = $_POST['user_name'];
    $phone_number = $_POST['phone_number'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password !== $confirm_password) {
        die("Passwords do not match.");
    }

    try {
        $stmt = $pdo->prepare("INSERT INTO buyers (email, user_name, phone_number, password) VALUES (?, ?, ?, ?)");
        $stmt->execute([$email, $user_name, $phone_number, $password]);

        echo "<script>alert('Signup successful.'); window.location.href = 'buyer-login.html';</script>";
    } catch (PDOException $e) {
        echo "<script>alert('Error: " . $e->getMessage() . "'); window.location.href = 'buyer-login.html';</script>";
    }
}
