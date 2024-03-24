<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "zerowaste";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
$email = $_POST['email'];
$password = $_POST['password'];

$email = stripslashes($email);
$password = stripslashes($password);
$email = $conn->real_escape_string($email);
$password = $conn->real_escape_string($password);

$sql = "SELECT * FROM sellers WHERE email='$email' and password='$password'";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
  $_SESSION['email'] = $email;
  header("location: seller-home-page-waste.php"); 
} else {
  echo "<script>alert('Invalid Seller Email or Password'); window.location.href = 'seller-login.html';</script>";
}

$conn->close();
}
?>
