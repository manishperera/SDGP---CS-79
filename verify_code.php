<?php

session_start();

try {
    $pdo = new PDO("mysql:host=localhost;dbname=zerowaste;charset=utf8mb4", "root", "", [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ]);
} catch (\PDOException $e) {
    error_log($e->getMessage());
    exit('Database connection error');  
}

$email = trim($_POST['email']);  
$entered_code = trim($_POST['verification_code']);  
if ($_SESSION['email'] !== $email) {
    exit('Session mismatch error');  
}

$stmt = $pdo->prepare("SELECT reset_code FROM buyers WHERE email = ?");
$stmt->execute([$email]);
$record = $stmt->fetch();

if ($entered_code === $record['reset_code']) { 
    header('Location: new-password.php?email=' . urlencode($email));
    exit;
} else {
    error_log("Entered code: $entered_code; Reset code: " . $record['reset_code']);
    echo "<script>alert('The verification code is incorrect. Please try again.'); window.location.href = 'verification.php';</script>";

}
?>
