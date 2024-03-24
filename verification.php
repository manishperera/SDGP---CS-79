<?php
session_start();
?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Verification</title>
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
<style>
  body, html {
    height: 100%;
    margin: 0;
  }
  .bg-image {
    background-image: url('');
    background-size: cover;
    background-position: center;
    height: 100%;
  }
  .verification-container {
    height: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
  }
  .verification-box {
    background-color: rgba(255, 255, 255, 0.8);
    padding: 40px;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    width: 400px;
    text-align: center;
  }
  .verification-input input {
  margin: 0 10px; 
  width: 50px; 
  height: 50px; 
  text-align: center;
  border-radius: 50%; 
  border: 2px solid #ddd; 
  font-size: 24px; 
  line-height: 50px; 
}

  .verification-input input {
    margin: 0 5px;
    text-align: center;
  }
  .btn-primary {
    background-color: #5cb85c;
    border: none;
  }
  .btn-primary:hover {
    background-color: #4cae4c;
  }
  .resend-link {
    display: block;
    margin-top: 15px;
  }
</style>
</head>
<body>
<?php
$email = isset($_SESSION['email']) ? $_SESSION['email'] : '';
?>


<div class="bg-image">
  <div class="verification-container">
    <div class="verification-box">
      <h2 class="text-center mb-4">Enter code, unlock possibilities, and journey seamlessly forward.</h2>
      <h2 class="text-center mb-4">Enter Verification Code</h2>
      <form action="verify_code.php" method="post">
          <div class="form-group">
              <input type="number" name="verification_code" placeholder="Enter your verification code" required class="form-control">
              <input type="hidden" name="email" value="<?php echo $email; ?>">
          </div>
          <button type="submit" class="btn btn-primary">Verify</button>
      </form>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</body>
</html>
