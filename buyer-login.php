<?php

session_start();

require __DIR__ . '/app/dbConnection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $email = $_POST['buyerId'];
  $password = $_POST['password'];

  $stmt = $pdo->prepare("SELECT * FROM buyers WHERE email = ? AND password = ?");
  $stmt->execute([$email, $password]);
  $result = $stmt->fetch();

  if ($result) {
    $_SESSION['login_user'] = $email;
    $_SESSION['username'] = $result['user_id'];

    $command = escapeshellcmd('python predict_waste.py');
    shell_exec($command);

    header("location: buyers-home-page.php");
    exit;
  } else {
    echo "<script>alert('Invalid Buyer Email or Password'); window.location.href = 'buyer-login.html';</script>";
  }
}
