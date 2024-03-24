<?php
session_start();

if (isset($_SESSION['username'])) {
    $pdo = new PDO('mysql:host=localhost;dbname=zerowaste;charset=utf8mb4', 'root', '', [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ]);

    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
    <meta charset="UTF-8">
    <title>Zero Waste - Buyer Home Page</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 0; box-sizing: border-box; background-image: url('https://cdn.ning.com/wp-content/uploads/2019/05/create-food-website.jpg'); 
        background-size: cover; background-position: center; ; }
        .container { width: 80%; margin: 0 auto; }
        .item, .food-item { background-color: #e8f5e9; margin-bottom: 20px; padding: 10px; cursor: pointer; }
        .item { border-radius: 8px; display: flex; align-items: center; }
        .food-item { border-radius: 50%; width: 150px; height: 150px; display: flex; justify-content: center; align-items: center; flex-direction: column; }
        .item img, .food-item img { border-radius: 50%; }
        .basic-info { display: flex; flex-direction: column; }
        .modal { display: none; position: fixed; z-index: 1; left: 0; top: 0; width: 100%; height: 100%; overflow: auto; background-color: rgb(0,0,0,0.4); }
        .modal-content { background-color: #fefefe; margin: 15% auto; padding: 20px; border: 1px solid #888; width: 80%; }
        .close { color: #aaa; float: right; font-size: 28px; font-weight: bold; }
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
        .category-buttons button { margin-right: 10px; padding: 10px 20px; border: none; border-radius: 20px; cursor: pointer; }
        .category-buttons { margin-bottom: 20px; }
        .food-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(150px, 1fr)); grid-gap: 20px; }
        .badge-success {
            color: white;
            background-color: #28a745;
            border-radius: 10px;
            padding: 5px 10px;
            font-size: 0.8em;
            position: absolute;
            top: 10px;
            right: 10px;
        }
        .item {
    position: relative;
}

.donated-label {
    position: absolute;
    top: 5px;
    right: 5px;
    background-color: #007bff;
    color: white;
    padding: 5px 10px;
    border-radius: 5px;
    font-size: 0.8em;
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

        .prediction-badge {
            position: fixed;
            bottom: 10px;
            left: 10px;
            background-color: #4CAF50;
            color: white;
            padding: 20px;
            border-radius: 50px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
            font-size: 0.9em;
            z-index: 10;
            cursor: pointer;
            transition: transform 0.3s ease-in-out;
        }

        
        .chat-modal {
            display: none;
            position: fixed;
            bottom: 0;
            right: 0;
            width: 300px;
            border: 1px solid #888;
            background: white;
            z-index: 1001;
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

        .highlight {
            color: purple; 
        }

        .modal-content {
            width: 50%;
        }

        .modal-content div {
            margin-bottom: 10px;
        }
    </style>
</head>
    <body>

        <div class="top-menu">
        <a href="buyer-login.html" class="buyer-login">Buyer Login</a>
        <a href="seller-login.html" class="seller-login">Seller Login</a>
        <img src="image/logo.png" alt="ZeroWaste Logo" class="logo">
        <a class="active" href="buyers-home-page.php">Products</a>
        <a href="about.html">About</a>
        <a href="resource.html">Tips</a>
        <a href="feedback.php">Feedback</a>
        <a href="waste-factoriesss.php">Waste Factories</a>
        <br><br><br><br><br><br>
        <div class="search-bar">
            <form action="buyers-home-page.php" method="GET">
                <input type="text" name="search" placeholder="Search" value="">
                <button type="submit">Search</button>
            </form>
        </div>
    </div>

    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <p id="modal-text"></p>
        </div>
    </div>
    <br><br><br>
    <div class="container">
        <header>
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

                

                $searchTerm = $_GET['search'] ?? '';
                $category = $_GET['category'] ?? '';
                $searchTerm = '%' . ($searchTerm) . '%';
            
                if ($category && $searchTerm) {
                    $query = 'SELECT * FROM waste WHERE category = ? AND name LIKE ?';
                    $stmt = $pdo->prepare($query);
                    $stmt->execute([$category, "%$searchTerm%"]);
                } elseif ($category) {
                    $query = 'SELECT * FROM waste WHERE category = ?';
                    $stmt = $pdo->prepare($query);
                    $stmt->execute([$category]);
                } elseif ($searchTerm) {
                    $query = 'SELECT * FROM waste WHERE name LIKE ?';
                    $stmt = $pdo->prepare($query);
                    $stmt->execute(["%$searchTerm%"]);
                } else {
                    $query = 'SELECT id, name, weight, price, image, contact, address, ratings, created_at, is_donation, seller_id FROM waste WHERE category = ?';
                $stmt = $pdo->prepare($query);
                $stmt->execute([$category]);
                }
                

                while ($row = $stmt->fetch()):
                    $isDonated = $row['is_donation'] == '1' || $row['is_donation'] == true;
                ?>
                    <div class='item' onclick="showModal(<?=htmlspecialchars(json_encode($row))?>)">
                       
                        <img src='image/2771401.png' alt='Image' width='100' height='100' style="border-radius: 8px;">
                        <div class='basic-info'>
                            <div class='item-name'><?php echo htmlspecialchars($row['name']); ?></div>
                            <div class='item-weight'><?php echo htmlspecialchars($row['weight']); ?> kg</div>
                            <div class='item-price'><?php echo htmlspecialchars($row['price']); ?> LKR/kg</div>
                            <?php if ($isDonated): ?>
                                <div class="donated-label">Donated</div>
                            <?php endif; ?>
                            <button onclick="openChatWithSeller(<?php echo $row['seller_id']; ?>)">Chat with Seller</button>
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
    const searchTerm = new URLSearchParams(window.location.search).get('search') || '';
    window.location.search = `?category=${category}&search=${searchTerm}`;
}



        function openChatWithSeller(sellerId) {
            window.location.href = `chat/chat.php?user=${sellerId}`;
        }
    </script>

    <?php
    $filename = 'predictions.txt';
    if (file_exists($filename)) {
        $prediction = file_get_contents($filename);
        echo "<div class='prediction-badge'>$prediction</div>";
    }
    ?>
</body>
</html>
<?php
}
?>