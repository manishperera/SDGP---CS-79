<?php

$db_configs = require __DIR__ . '/configs/phoenix.php';

use PDOException;

$env = $db_configs['default_environment'];

$db = $db_configs['environments'][$env];

$adapter = $db['adapter'];
$host = $db['host'];
$port = $db['port'];
$user = $db['username'];
$password = $db['password'];
$dbname = $db['db_name'];

$dsn = "$adapter:host=$host;port=$port;dbname=$dbname";

$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

try {
    $pdo = new PDO($dsn, $user, $password, $options);
} catch (PDOException $e) {
    throw new PDOException($e->getMessage(), (int) $e->getCode());
}
