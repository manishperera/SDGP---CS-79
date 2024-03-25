<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Feedback Form</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: #f7f7f7;
      font-family: Arial, sans-serif;
      background: url('https://cdn.ning.com/wp-content/uploads/2019/05/create-food-website.jpg') no-repeat center center fixed;
      background-size: cover;
    }

    .feedback-container {
      background: white;
      border-radius: 8px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      padding: 20px;
      margin-top: 20px;
    }

    .feedback-title {
      text-align: center;
      margin-bottom: 20px;
    }

    .stars-rating {
      text-align: center;
      font-size: 24px;
      color: #FFD700;
    }

    .improvement-section {
      margin: 20px 0;
    }

    .improvement-checkboxes label {
      margin-right: 15px;
    }

    .submit-btn {
      background-color: #4CAF50;
      color: white;
      border: none;
      border-radius: 4px;
      padding: 10px 20px;
      font-size: 16px;
      cursor: pointer;
      display: block;
      width: 100%;
    }

    .submit-btn:hover {
      background-color: #45a049;
    }

    .feedback-form {
      max-width: 400px;
      margin: auto;
    }

    .top-menu {
      background-image: url('https://img.freepik.com/free-photo/various-vegetables-black-table-with-space-message_1220-616.jpg?w=1060&t=st=1711199448~exp=1711200048~hmac=424d84a0e95ed8649330086f707e23d7e371613e4601947871dc21f5ffc27c64');
      background-size: cover;
      background-position: center;
      padding-bottom: 50px;
      position: relative;
      border-bottom: 3px solid #4CAF50;
    }

    .top-menu a {
      float: left;
      display: block;
      color: black;
      text-align: center;
      padding: 10px 20px;
      text-decoration: none;
      font-size: 17px;
      background: white;
      border-radius: 20px;
      margin: 30px 30px 0 10px;
    }

    .top-menu a:hover {
      background-color: #8BC34A;
      color: black;
    }

    .top-menu a.active {
      background-color: #4CAF50;
      color: black;
    }

    .logo {
      float: left;
      margin-right: 20px;
      padding: 10px 0;
      height: 160px;
    }

    .search-bar {
      position: absolute;
      left: 50%;
      transform: translateX(-50%);
      bottom: 10px;
      width: 60%;
    }

    .search-bar input {
      width: 30%;
      padding: 10px;
      margin: 0;
      border: none;
      border-radius: 20px;
      align-items: center;
    }

    .top-menu::after {
      content: "";
      display: table;
      clear: both;
    }

    .star-rating {
      direction: rtl;
      font-size: 30px;
      unicode-bidi: bidi-override;
      display: inline-block;
    }

    .star-rating input {
      display: none;
    }

    .star-rating label {
      color: #ccc;
      cursor: pointer;
    }

    .star-rating label:hover,
    .star-rating label:hover~label,
    .star-rating input:checked~label {
      color: #f0ad4e;
    }

    .chat-button {
      position: fixed;
      bottom: 20px;
      right: 20px;
      z-index: 1000;
    }

    .chat-button .open-chat {
      background-color: #007bff;
      color: white;
      padding: 10px 20px;
      border-radius: 20px;
      text-decoration: none;
      font-size: 1em;
      box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.2);
      transition: background-color 0.3s;
    }

    .chat-button .open-chat:hover {
      background-color: #0056b3;
    }

    .buyer-login {
      position: absolute;
      top: 10px;
      right: 10px;
      background-color: #4CAF50;
      color: green;
      padding: 10px 20px;
      border-radius: 20px;
      text-decoration: none;
      margin-bottom: 10px;
    }

    .seller-login {
      position: absolute;
      top: 60px;
      right: 10px;
      background-color: #FF5733;
      color: white;
      padding: 10px 20px;
      border-radius: 20px;
      text-decoration: none;
    }
  </style>
</head>

<body>
  <div class="top-menu">
    <img src="image/logo.png" alt="ZeroWaste Logo" class="logo">
    <a href="buyer-login.html" class="buyer-login">Buyer Login</a>
    <a href="seller-login.html" class="seller-login">Seller Login</a>
    <a href="buyers-home-page.php">Products</a>
    <a href="about.html">About</a>
    <a href="resource.html">Tips</a>
    <a class="active" href="feedback.php">Feedback</a>
    <a href="waste-factoriesss.php">Waste Factories</a>

    <br> <br> <br> <br> <br> <br>

  </div>

  <div class="container">
    <div class="feedback-container">
      <div class="feedback-title">
        <h2>Feedback</h2>
      </div>
      <form id="feedback-form" method="post" action="submit-feedback.php">
        <div class="stars-rating">
          <input type="radio" id="star5" name="rating" value="1" /><label for="star1">☆</label>
          <input type="radio" id="star4" name="rating" value="2" /><label for="star2">☆</label>
          <input type="radio" id="star3" name="rating" value="3" /><label for="star3">☆</label>
          <input type="radio" id="star2" name="rating" value="4" /><label for="star4">☆</label>
          <input type="radio" id="star1" name="rating" value="5" /><label for="star5">☆</label>
        </div>
        <p>Tell us what can be improved</p>
        <div class="improvement-checkboxes">
          <label><input type="checkbox" name="improvement[]" value="Overall Service"> Overall Service</label>
          <label><input type="checkbox" name="improvement[]" value="Customer Support"> Customer Support</label>
          <label><input type="checkbox" name="improvement[]" value="Transparency"> Transparency</label>
        </div>
        <div class="form-group">
          <label for="otherSuggestions">Other suggestions</label>
          <textarea class="form-control" id="otherSuggestions" name="suggestions" rows="3"></textarea>
        </div>
        <button type="submit" class="submit-btn">Submit</button>
      </form>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</body>

</html>