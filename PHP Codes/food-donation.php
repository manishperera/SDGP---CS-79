<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Zero Waste - Buyer Home Page</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 0; box-sizing: border-box; }
        .container { width: 80%; margin: 0 auto; }
        .search-bar input { width: 100%; padding: 10px; margin-bottom: 20px; }
        .item, .food-item { background-color: #e8f5e9; margin-bottom: 20px; padding: 10px; cursor: pointer; }
        .item { border-radius: 8px; display: flex; align-items: center; }
        .food-item { border-radius: 50%; width: 150px; height: 150px; display: flex; justify-content: center; align-items: center; flex-direction: column; }
        .item img, .food-item img { border-radius: 50%; }
        .basic-info { display: flex; flex-direction: column; }
        .modal { display: none; position: fixed; z-index: 1; left: 0; top: 0; width: 100%; height: 100%; overflow: auto; background-color: rgb(0,0,0,0.4); }
        .modal-content { background-color: #fefefe; margin: 15% auto; padding: 20px; border: 1px solid #888; width: 80%; }
        .close { color: #aaa; float: right; font-size: 28px; font-weight: bold; }
        .top-menu { background-color: #4CAF50; overflow: hidden; }
        .top-menu a { float: left; display: block; color: white; text-align: center; padding: 14px 16px; text-decoration: none; font-size: 17px; }
        .top-menu a:hover { background-color: #ddd; color: black; }
        .top-menu a.active { background-color: #8BC34A; color: white; }
        .category-buttons button { margin-right: 10px; padding: 10px 20px; border: none; border-radius: 20px; cursor: pointer; }
        .category-buttons { margin-bottom: 20px; }
        .food-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(150px, 1fr)); grid-gap: 20px; }
        
    </style>
</head>
<body>

<div class="top-menu">
<a class="active" href="buyers-home-page.php">Products</a>
    <a href="about.html">About</a>
    <a href="#resources">Resources</a>
    <a href="food-donation.html">Donations</a>
    <a href="#feedback">Feedback</a>
</div>

<div id="myModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <p id="modal-text"></p>
    </div>
</div>

<div class="container">
    <header>
        <div class="search-bar">
            <input type="text" placeholder="Search">
        </div>
        <div class="category-buttons">
            <button onclick="filterCategory('food')">Food</button>
            <button onclick="filterCategory('waste')">Waste</button>
        </div>
    </header>

    <main>
        <section class="items-list">
            <?php
            $pdo = new PDO('mysql:host=localhost;dbname=zerowaste;charset=utf8mb4', 'root', '', [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ]);
            
            $category = $_GET['category'] ?? 'waste';
            $query = 'SELECT id, name, weight, price, image, contact, address, ratings, created_at FROM waste WHERE category = ?';
            $stmt = $pdo->prepare($query);
            $stmt->execute([$category]);

            while ($row = $stmt->fetch()):
            ?>
                <div class='item' onclick='showModal(<?php echo json_encode($row); ?>)'>
                    <img src='<?php echo $row['image']; ?>' alt='Image' width='100' height='100'>
                    <div class='basic-info'>
                        <div class='item-name'><?php echo $row['name']; ?></div>
                        <div class='item-weight'><?php echo $row['weight']; ?> kg</div>
                        <div class='item-price'><?php echo $row['price']; ?> LKR/kg</div>
                    </div>
                </div>
            <?php endwhile; ?>
            </section>
            
    </main>
</div>

<script>
var modal = document.getElementById("myModal");
var modalText = document.getElementById("modal-text");
var span = document.getElementsByClassName("close")[0];

function showModal(item) {
    var content = '<div><strong>Name:</strong> ' + item.name + '</div>' +
                  '<div><strong>Weight:</strong> ' + item.weight + ' kg</div>' +
                  '<div><strong>Price:</strong> ' + item.price + ' LKR/kg</div>' +
                  '<div><strong>Contact:</strong> ' + item.contact + '</div>' +
                  '<div><strong>Address:</strong> ' + item.address + '</div>' +
                  '<div><strong>Ratings:</strong> ' + item.ratings + ' / 5 Stars</div>' +
                  '<div><strong>Date:</strong> ' + new Date(item.created_at).toLocaleString() + '</div>';
    modalText.innerHTML = content;
    modal.style.display = "block";
}

span.onclick = function() {
    modal.style.display = "none";
}

window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

function filterCategory(category) {
    window.location.search = '?category=' + category;
}
</script>


<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#donationModal">
            Donate
        </button>
        
        <div class="modal fade" id="donationModal" tabindex="-1" aria-labelledby="donationModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="donationModalLabel">Donate Food</h5>
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="donationForm">
                            <div class="form-group">
                                <label for="foodName">Food Name</label>
                                <input type="text" class="form-control" id="foodName" name="foodName">
                            </div>
                            <div class="form-group">
                                <label for="quantity">Quantity</label>
                                <input type="number" class="form-control" id="quantity" name="quantity">
                            </div>
                            <div class="form-group">
                                <label for="expiryDate">Expiry Date</label>
                                <input type="date" class="form-control" id="expiryDate" name="expiryDate">
                            </div>
                            <button type="submit" class="btn btn-success">Submit Donation</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
