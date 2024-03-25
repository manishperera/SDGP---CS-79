<?php

session_start();

require __DIR__ . '/app/dbConnection.php';

$email = $_POST['email'] ?? '';
$new_password = $_POST['new_password'] ?? '';
$confirm_password = $_POST['confirm_password'] ?? '';

if ($new_password === $confirm_password) {
    try {
        $stmt = $pdo->prepare("UPDATE buyers SET password = ? WHERE email = ?");
        $stmt->execute([$new_password, $email]);

        echo "<script>alert('Your password has been updated successfully.'); window.location.href = 'loginPage.html';</script>";
    } catch (\PDOException $e) {
        error_log($e->getMessage());
        echo "<script>alert('An error occurred while updating your password. Please try again later.'); window.location.href = 'loginPage.html';</script>";
    }
} else {
    echo "<script>alert('The passwords do not match. Please try again.'); window.location.href = 'loginPage.html';</script>";
}
