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
        .category-buttons button { margin-right: 10px; padding: 10px 20px; border: none; border-radius: 20px; cursor: pointer; }
        .category-buttons { margin-bottom: 20px; }
        .food-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(150px, 1fr)); grid-gap: 20px; }
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
.category-buttons button { margin-right: 10px; padding: 10px 20px; border: none; border-radius: 20px; cursor: pointer; }
        .category-buttons { margin-bottom: 20px; }
    </style>
</head>
<body>

<div class="top-menu">
<img src="image/logo.png" alt="ZeroWaste Logo" class="logo">
    <a class="active" href="buyers-home-page.php">Products</a>
    <a href="about.html">About</a>
    <a href="resource.html">Resources</a>
    <a href="feedback.php">Feedback</a>
    <br> <br> <br> <br> <br> <br>
    <div class="search-bar">
        <input type="text" placeholder="Search">
    </div>
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
            $query = 'SELECT id, name, weight, price, image, contact, address, ratings, created_at FROM waste WHERE category = ? and is_donation="true"';
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

<div class="chat-button">
  <a href="index.php" class="open-chat">Live Chat</a>
</div>


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
