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

$email = stripslashes($email);
$password = stripslashes($password);
$email = $conn->real_escape_string($email);
$password = $conn->real_escape_string($password);

$sql = "SELECT * FROM buyers WHERE email='$email' and password='$password'";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
  $row = $result->fetch_assoc();
  $_SESSION['login_user'] = $email;
  $_SESSION['username'] = $row['user_id'];

  $command = escapeshellcmd('python predict_waste.py');
  shell_exec($command);
  header("location: buyers-home-page.php"); 
} else {
  echo "<script>alert('Invalid Buyer Email or Password'); window.location.href = 'buyer-login.html';</script>";
}

$conn->close();
}
?>
