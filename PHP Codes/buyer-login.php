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
$email = $_POST['buyerId'];
$password = $_POST['password'];

$seller_id = stripslashes($email);
$password = stripslashes($password);
$seller_id = $conn->real_escape_string($seller_id);
$password = $conn->real_escape_string($password);

$sql = "SELECT * FROM buyers WHERE email='$email' and password='$password'";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
  $_SESSION['login_user'] = $seller_id;
  header("location: buyers-home-page.php"); 
} else {
  echo "<alert>Invalid Seller ID or Password</alert>";
}

$conn->close();
}
?>

