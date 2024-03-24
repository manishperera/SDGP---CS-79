<!DOCTYPE html>
<html>
<head>
    <title>Waste Predictions</title>
</head>
<body>
    <h1>Waste Predictions</h1>
    <?php
    $filename = 'predictions.txt';
    if (file_exists($filename)) {
        $predictions = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        echo '<ul>';
        foreach ($predictions as $prediction) {
            echo "<li>Predicted Waste: $prediction kg</li>";
        }
        echo '</ul>';
    } else {
        echo '<p>Predictions file not found.</p>';
    }
    ?>
</body>
</html>
