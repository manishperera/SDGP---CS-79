<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Zero Waste - Buyer Home Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        .container {
            width: 80%;
            margin: 0 auto;
        }
        .search-bar {
            margin: 20px 0;
        }
        .search-bar input {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
        }
        .item {
            background-color: #e8f5e9;
            border-radius: 8px;
            margin-bottom: 20px;
            padding: 10px;
            display: flex;
            align-items: center;
        }
        .item img {
            border-radius: 50%;
            margin-right: 20px;
        }
        .item-details {
            display: flex;
            flex-direction: column;
        }
        .pagination {
            text-align: center;
            margin-top: 20px;
        }
        .pagination span {
            margin: 0 5px;
            cursor: pointer;
        }
        .category-buttons button {
            margin-right: 10px;
            padding: 10px 20px;
            border: none;
            border-radius: 20px;
            cursor: pointer;
        }
        .category-buttons {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<div class="container">
    <header>
        <div class="search-bar">
            <input type="text" placeholder="Search">
        </div>
    </header>

    <main>
        <div class="category-buttons">
            <button>Food</button>
            <button>Waste</button>
        </div>

        <section class="items-list">
            <?php
            $stmt = $pdo->query('SELECT name, weight, price, image FROM waste_providers WHERE category = "waste"');
            while ($row = $stmt->fetch()) {
                echo "<div class='item'>";
                echo "<img src='" . htmlspecialchars($row['image']) . "' alt='Image' width='100' height='100'>";
                echo "<div class='item-details'>";
                echo "<div class='item-name'>" . htmlspecialchars($row['name']) . "</div>";
                echo "<div class='item-weight'>" . htmlspecialchars($row['weight']) . " kg</div>";
                echo "<div class='item-price'>" . htmlspecialchars($row['price']) . " LKR/kg</div>";
                echo "</div>";
                echo "</div>";
            }
            ?>
        </section>

        <div class="pagination">
            <span>&laquo;</span>
            <span>1</span>
            <span>2</span>
            <span>3</span>
            <span>&raquo;</span>
        </div>
    </main>
</div>

</body>
</html>
