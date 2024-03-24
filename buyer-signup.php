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
    $user_name = $conn->real_escape_string($_POST['user_name']);
    $phone_number = $conn->real_escape_string($_POST['phone_number']);
    $password = $conn->real_escape_string($_POST['password']);
    $confirm_password = $conn->real_escape_string($_POST['confirm_password']);

    if ($password !== $confirm_password) {
        die("Passwords do not match.");
    } else {
        

        $sql = $conn->prepare("INSERT INTO buyers (email, user_name, phone_number, password) VALUES (?, ?, ?, ?)");
        $sql->bind_param("ssss", $email, $user_name, $phone_number, $password);

        if ($sql->execute()) {
            echo "<script>alert('Signup successful.'); window.location.href = 'buyer-login.html';</script>";

        } else {
            echo "<script>alert('Error:  . $sql->error'); window.location.href = 'buyer-login.html';</script>";
        }

        $sql->close();
    }
}

$conn->close();
?>
