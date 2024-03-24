<?php

session_start();

if (!isset($_SESSION["email"])) {
    http_response_code(403);
    header('Location: loginPage.html');
    exit;


    
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Seller Home Page - Waste</title>
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
<style>
  body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background: url('https://cdn.ning.com/wp-content/uploads/2019/05/create-food-website.jpg') no-repeat center center fixed;
            background-size: cover;
        }
  .rounded-circle {
    width: 100px;
    height: 100px;
    object-fit: cover;
  }
  .seller-info {
    text-align: center;
    margin-top: 20px;
    color: azure;
  }
  .waste-items-list {
    margin-top: 20px;
  }
  .modal-content input,
  .modal-content select {
    margin-bottom: 10px;
  }
  .card {
    margin: 10px 0;
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
        .logo {
    float: left;
    margin-right: 20px;
    padding: 10px 0;
    height: 160px;
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
.donated-label {
    display: inline-block;
    background-color: #007bff;
    color: white;
    padding: 5px 10px;
    border-radius: 5px;
    font-size: 0.8em;
    margin-left: auto;
    position: absolute;
    top: 10px;
    right: 10px;
}
</style>
</head>
<body>

<div class="top-menu">
<img src="image/logo.png" alt="ZeroWaste Logo" class="logo">
<a href="buyer-login.html" class="buyer-login">Buyer Login</a>
    <a href="seller-login.html" class="seller-login">Seller Login</a>
    <a class="active" href="buyers-home-page.php">Products</a>
    <a href="about.html">About</a>
    <a href="resource.html">Resources</a>
    <a href="feedback.php">Feedback</a>
    <a href="waste-factoriesss.php">Waste Factories</a>
    <br> <br> <br> <br> <br> <br>
    <div class="search-bar">
            <form action="seller-home-page-waste.php" method="GET">
                <input type="text" name="search" placeholder="Search" value="">
                <button type="submit">Search</button>
            </form>
    </div>
</div>
<?php
$email = $_SESSION["email"];
$pdo = new PDO('mysql:host=localhost;dbname=zerowaste;charset=utf8mb4', 'root', '', [
  PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
  PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
  PDO::ATTR_EMULATE_PREPARES => false,
]);
$stmt = $pdo->prepare("SELECT id, seller_name FROM sellers WHERE email = :email");
$stmt->execute(['email' => $email]);
$seller = $stmt->fetch();

if (!$seller) {
    die("Error: Seller not found.");
}

$seller_id = $seller['id'];
$seller_name = $seller['seller_name'];
?>

<div class="seller-info">
  <img src="image/user-icon-2048x2048-ihoxz4vq.png" alt="Seller Store" class="rounded-circle">
  <h2><?php echo htmlspecialchars($seller_name); ?></h2>
</div>

<?php
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



$seller_email = $_SESSION['email'];
$stmt = $pdo->prepare("SELECT id FROM sellers WHERE email = :email");
$stmt->execute(['email' => $seller_email]);
$seller_id = $stmt->fetchColumn();

$waste_items = [];
$stmt = $pdo->prepare("SELECT * FROM waste WHERE seller_id = :seller_id");
$stmt->execute(['seller_id' => $seller_id]);
$waste_items = $stmt->fetchAll();
?>

<div class="container waste-items-list">
    <?php foreach ($waste_items as $item): 
      $isDonated = $item['is_donation'] == '1' || $item['is_donation'] == true;?>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title"><?php echo htmlspecialchars($item['name']); ?></h5>
                <p class="card-text"><?php echo htmlspecialchars($item['weight']); ?> kg - <?php echo htmlspecialchars($item['price']); ?> LKR/kg</p>
                <p class="card-text"><small class="text-muted">Posted on <?php echo htmlspecialchars($item['created_at']); ?></small></p>
                <?php if ($isDonated): ?>
                    <div class="donated-label">Donated</div>
                <?php endif; ?>
                <button class="btn btn-danger delete-item" data-id="<?php echo $item['id']; ?>">Delete</button>
            </div>
        </div>
    <?php endforeach; ?>
</div>




<div class="container text-center mt-4">
  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addItemModal">
    Add More Items
  </button>
  <button type="button" class="btn btn-success" data-toggle="modal" data-target="#donateItemModal">
    Donate
  </button>
</div>

<div class="modal fade" id="addItemModal" tabindex="-1" aria-labelledby="addItemModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addItemModalLabel">Add Waste Item</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="addItemForm" action="add-waste-item.php" method="POST">
        <div class="form-group">
            <label for="wasteName">Item Name</label>
            <input type="text" class="form-control" id="wasteName" name="name" required>
          </div>
          <div class="form-group">
            <label for="wasteWeight">Weight (kg)</label>
            <input type="number" class="form-control" id="wasteWeight" name="weight" required>
          </div>
          <div class="form-group">
            <label for="wastePrice">Price per Kilogram (LKR)</label>
            <input type="number" class="form-control" id="wastePrice" name="price" required>
          </div>
          <div class="form-group">
            <label for="wasteCategory">Category</label>
            <select class="form-control" id="wasteCategory" name="category" required>
              <option value="food">Food</option>
              <option value="waste">Waste</option>
            </select>
          </div>
          <div class="form-group">
            <label for="wasteImage">Image URL</label>
            <input type="text" class="form-control" id="wasteImage" name="image">
          </div>
          
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" form="addItemForm" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="donateItemModal" tabindex="-1" aria-labelledby="donateItemModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="donateItemModalLabel">Donate Item</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="donateItemForm" action="donate-item.php" method="POST">
        <div class="form-group">
            <label for="wasteName">Item Name</label>
            <input type="text" class="form-control" id="wasteName" name="name" required>
          </div>
          <div class="form-group">
            <label for="wasteWeight">Weight (kg)</label>
            <input type="number" class="form-control" id="wasteWeight" name="weight" required>
            </div>
      <div class="form-group">
        <label for="donationCategory">Category</label>
        <select class="form-control" id="donationCategory" name="category" required>
          <option value="food">Food</option>
          <option value="waste">Waste</option>
        </select>
      </div>
      <div class="form-group">
        <label for="donationImage">Image URL</label>
        <input type="text" class="form-control" id="donationImage" name="image">
      </div>
    </form>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    <button type="submit" form="donateItemForm" class="btn btn-success">Donate</button>
  </div>
</div>
</div>

</div>
<div class="chat-button">
  <a href="SellerChat/index.php" class="open-chat">Chat</a>
</div>

<script>
$(document).ready(function() {
  $('#addItemForm').on('submit', function(e) {
    e.preventDefault();
    var formData = $(this).serialize();

    $.ajax({
      type: 'POST',
      url: 'add-waste-item.php',
      data: formData,
      success: function(response) {
        alert('Waste item added successfully!');
        $('#addItemModal').modal('hide');
        location.reload();
      },
      error: function(jqXHR, textStatus, errorThrown) {
        console.error('Error adding item: ' + textStatus, errorThrown);
      }
    });
  });

  $('#donateItemForm').on('submit', function(e) {
    e.preventDefault();
    var formData = $(this).serialize();

    $.ajax({
      type: 'POST',
      url: 'donate-item.php',
      data: formData,
      success: function(response) {
        alert('Item donated successfully!');
        $('#donateItemModal').modal('hide');
        location.reload();
      },
      error: function(jqXHR, textStatus, errorThrown) {
        console.error('Error donating item: ' + textStatus, errorThrown);
      }
    });
  });
});





</script>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script>
  $(document).ready(function() {
    $('.delete-item').click(function() {
      var itemId = $(this).data('id');
      if (confirm('Are you sure you want to delete this item?')) {
        $.ajax({
          type: 'POST',
          url: 'delete-item.php',
          data: { id: itemId },
          success: function(response) {
            alert('Item deleted successfully!');
            location.reload();
          },
          error: function(jqXHR, textStatus, errorThrown) {
            console.error('Error deleting item: ' + textStatus, errorThrown);
          }
        });
      }
    });
  });
</script>

</body>
</html>