<?php

session_start();

require __DIR__ . '/app/dbConnection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $rating = $_POST['rating'] ?? 0;
    $suggestions = $_POST['suggestions'] ?? '';
    $improvements = $_POST['improvement'] ?? [];

    $improvements_str = join(', ', $improvements);

    try {
        $stmt = $pdo->prepare("INSERT INTO feedback (rating, suggestions, improvements) VALUES (?, ?, ?)");
        $stmt->execute([$rating, $suggestions, $improvements_str]);

        echo "<script>alert('Feedback submitted successfully!'); window.location.href='feedback.php';</script>";
    } catch (\PDOException $e) {
        error_log($e->getMessage());
        echo "<script>alert('An error occurred while submitting feedback. Please try again later.'); window.location.href='feedback.php';</script>";
    }
}