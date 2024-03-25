<?php

session_start();

require __DIR__ . '/app/dbConnection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $email = $_POST['email'];
  $password = $_POST['password'];

  $stmt = $pdo->prepare("SELECT * FROM sellers WHERE email = ? AND password = ?");
  $stmt->execute([$email, $password]);
  $result = $stmt->fetch();

  if ($result) {
    $_SESSION['email'] = $email;
    header("location: seller-home-page-waste.php");
    exit;
  } else {
    echo "<script>alert('Invalid Seller Email or Password'); window.location.href = 'seller-login.html';</script>";
  }
}
