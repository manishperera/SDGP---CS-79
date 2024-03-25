<?php

session_start();

require __DIR__ . '/app/dbConnection.php';

$email = trim($_POST['email']);
$entered_code = trim($_POST['verification_code']);
if ($_SESSION['email'] !== $email) {
    exit('Session mismatch error');
}

$stmt = $pdo->prepare("SELECT reset_code FROM buyers WHERE email = ?");
$stmt->execute([$email]);
$record = $stmt->fetch();

if ($record) {
    if ($entered_code === $record['reset_code']) {
        header('Location: new-password.php?email=' . urlencode($email));
        exit;
    } else {
        error_log("Entered code: $entered_code; Reset code: " . $record['reset_code']);
        echo "<script>alert('The verification code is incorrect. Please try again.'); window.location.href = 'verification.php';</script>";
    }
} else {
    echo "<script>alert('Email not found.'); window.location.href = 'verification.php';</script>";
}
