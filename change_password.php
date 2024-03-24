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

$email = $_POST['email'];
$new_password = $_POST['new_password'];
$confirm_password = $_POST['confirm_password'];

if ($new_password === $confirm_password) {

    $stmt = $pdo->prepare("UPDATE buyers SET password = ? WHERE email = ?");
    $stmt->execute([$new_password, $email]);


    echo "<script>alert('Your password has been updated successfully.'); window.location.href = 'loginPage.html';</script>";

} else {
    echo "<script>alert('The passwords do not match. Please try again.'); window.location.href = 'loginPage.html';</script>";
}
?>
