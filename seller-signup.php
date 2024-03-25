<?php

require __DIR__ . '/app/dbConnection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $email = $_POST['email'];
  $seller_name = $_POST['seller_name'];
  $phone_number = $_POST['phone_number'];
  $address = $_POST['address'];
  $password = $_POST['password'];
  $confirm_password = $_POST['confirm_password'];
  $business_type = $_POST['business_type'];

  if ($password !== $confirm_password) {
    echo "Passwords do not match.";
  } else {
    try {
      $stmt = $pdo->prepare("INSERT INTO sellers (email, seller_name, phone_number, address, password, business_type) VALUES (?, ?, ?, ?, ?, ?)");
      $stmt->execute([$email, $seller_name, $phone_number, $address, $password, $business_type]);

      echo "<script>
                    alert('Successfully signed in!');
                    window.location.href = 'seller-login.html';
                </script>";
    } catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
    }
  }
}
