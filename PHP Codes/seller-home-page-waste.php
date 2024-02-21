<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Seller Home Page - Waste</title>
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
<style>
  .rounded-circle {
    width: 100px;
    height: 100px;
    object-fit: cover;
  }
  .seller-info {
    text-align: center;
    margin-top: 20px;
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
            background-image: url('https://img.freepik.com/free-photo/bottom-view-fresh-vegetables-red-greeen-bell-peppers-cherry-tomatoes-dill-parsley-tomatoes-dark-surface-with-copy-place_140725-102757.jpg?w=996&t=st=1708460991~exp=1708461591~hmac=8d057986c9d824ea366d65189817730bd2a523381f0befed3afef9639859aabb');
            background-size: cover;
            background-position: center;
            padding-bottom: 50px;
            position: relative;
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
        }
</style>
</head>
<body>

<div class="top-menu">
<img src="path-to-your-logo.png" alt="ZeroWaste Logo" class="logo">
    <a class="active" href="buyers-home-page.php">Products</a>
    <a href="about.html">About</a>
    <a href="#resources">Resources</a>
    <a href="food-donation.html">Donations</a>
    <a href="#feedback">Feedback</a>
    <br> <br> <br> <br> <br> <br>
</div>

<div class="seller-info">
  <img src="path-to-seller-image.jpg" alt="Seller Store" class="rounded-circle">
  <h2>Lucky Grocery Store</h2>
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

session_start();
if (!isset($_SESSION['email'])) {
    header('Location: loginPage.html');
    exit;
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
    <?php foreach ($waste_items as $item): ?>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title"><?php echo htmlspecialchars($item['name']); ?></h5>
                <p class="card-text"><?php echo htmlspecialchars($item['weight']); ?> kg - <?php echo htmlspecialchars($item['price']); ?> LKR/kg</p>
                <p class="card-text"><small class="text-muted">Posted on <?php echo htmlspecialchars($item['created_at']); ?></small></p>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<div class="container text-center mt-4">;
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
</body>
</html>