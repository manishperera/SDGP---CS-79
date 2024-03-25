<?php

session_start();

require __DIR__ . '/../../../app/dbConnection.php';

if (isset($_SESSION['username'])) {

	$id = $_SESSION['user_id'];

	$sql = "UPDATE users SET last_seen = NOW() WHERE user_id = ?";
	$stmt = $pdo->prepare($sql);
	$stmt->execute([$id]);

} else {
	header("Location: ../../index.php");
	exit;
}