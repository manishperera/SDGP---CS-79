<?php

require __DIR__ . '/../vendor/autoload.php';

use Dotenv\Dotenv;

Dotenv::createUnsafeImmutable([__DIR__ . '/../'])->load();

/**
 * Now you can load env values as a helper function 
 * echo getenv('APP_ENV'); 
 * echo $_ENV['APP_NAME'];
 */
