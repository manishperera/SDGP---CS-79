<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Waste Details</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
    <style>
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
        <a href="feedback.php">Feedback</a>
        <a class="active" href="waste-factoriesss.php">Waste Factories</a>

        <br> <br> <br> <br> <br> <br>

    </div>

    <div class="container mt-4">
        <h2>Waste Factories</h2>
        <div class="row">
            <?php
            require __DIR__ . '/app/dbConnection.php';

            try {
                $stmt = $pdo->query('SELECT id, name, details, image, contact, efficiency FROM waste_factories');
                while ($row = $stmt->fetch()) {
                    echo '<div class="col-md-4 mb-3">';
                    echo '<div class="card" data-toggle="modal" data-target="#detailsModal" data-id="' . $row['id'] . '">';
                    echo '<img src="' . $row['image'] . '" class="card-img-top" alt="Factory Image">';
                    echo '<div class="card-body">';
                    echo '<h5 class="card-title">' . $row['name'] . '</h5>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                }
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
            ?>
        </div>
    </div>

    <div class="modal fade" id="detailsModal" tabindex="-1" aria-labelledby="detailsModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailsModalLabel">Factory Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function () {
            $('.card').click(function () {
                var factoryId = $(this).data('id');
                $.ajax({
                    url: 'fetch-details.php',
                    type: 'GET',
                    data: { id: factoryId },
                    success: function (data) {
                        $('#detailsModal .modal-body').html(data);
                    }
                });
            });
        });
    </script>
</body>

</html>