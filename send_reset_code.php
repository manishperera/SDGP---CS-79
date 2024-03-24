<?php
// db.php
$host = 'localhost';
$db   = 'zerowaste';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}
?>


<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$email = $_POST['email_or_phone'];  // From form input
$verification_code = rand(100000,999999); // Generate a 6-digit code

// Check if the user exists and save the verification code in the database
$stmt = $pdo->prepare("SELECT * FROM buyers WHERE email = ?");
$stmt->execute([$email]);
$user = $stmt->fetch();

if ($user) {
    $_SESSION['email'] = $email;
}


if ($user) {
// Update the user's record with the new verification code
$updateStmt = $pdo->prepare("UPDATE buyers SET reset_code = ? WHERE email = ?");
$updateStmt->execute([$verification_code, $email]);
$mail = new PHPMailer(true);
try {
    //Server settings
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'imnotwhatyout@gmail.com'; // SMTP username
    $mail->Password = 'nfns wxmc rnrm mypg'; // SMTP password (Use an App password for Gmail)
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    //Recipients
    $mail->setFrom('imnotwhatyout@gmail.com', 'Mailer');
    $mail->addAddress($email); // Add the recipient

    //Content
    $mail->isHTML(true);
    $mail->Subject = 'Password Reset Verification';
    $mail->Body    = 'Your verification code is ' . $verification_code;

    $mail->send();
    echo "<script>alert('Verification code sent.'); window.location.href = 'verification.php';</script>";
} catch (Exception $e) {
    echo 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo;
}

} else {
    echo 'No user found with that email address.';
    }
    ?>

