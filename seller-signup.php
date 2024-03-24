<?php


$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "zerowaste"; 

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $email = $conn->real_escape_string($_POST['email']);
  $seller_name = $conn->real_escape_string($_POST['seller_name']);
  $phone_number = $conn->real_escape_string($_POST['phone_number']);
  $address = $conn->real_escape_string($_POST['address']);
  $password = $conn->real_escape_string($_POST['password']);
  $confirm_password = $conn->real_escape_string($_POST['confirm_password']);
  $business_type = $conn->real_escape_string($_POST['business_type']);

  if ($password !== $confirm_password) {
    echo "Passwords do not match.";
  } else {

    

    $sql = "INSERT INTO sellers (email, seller_name, phone_number, address, password, business_type) VALUES ('$email', '$seller_name', '$phone_number', '$address', '$password', '$business_type')";

    if ($conn->query($sql) === TRUE) {
      echo "<script>
              alert('Successfully signed in!');
              window.location.href = 'seller-login.html';
            </script>";
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
  }
}

$conn->close();
?>
