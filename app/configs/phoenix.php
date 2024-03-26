<?php

require __DIR__ . '/../env.php';

return [
    'migration_dirs' => [
        'migrations' => __DIR__ . '/../database/migrations',
        //'SecondMigrations' => __DIR__ . '/../second_dir',
    ],
    'environments' => [
        'local' => [
            'adapter' => 'mysql',
            'host' => getenv('DB_HOST') ?? 'localhost',
            'port' => getenv('DB_PORT') ?? 3306, // optional
            'username' => getenv('DB_USER') ?? 'root',
            'password' => getenv('DB_PASSWORD') ?? '',
            'db_name' => getenv('DB_NAME') ?? 'SDGP',
            'charset' => getenv('DB_CHARSET') ?? 'utf8mb4',
            'collation' => getenv('DB_COLLATION') ?? 'utf8mb4_general_ci', // optional, if not set default collation for utf8mb4 is used
        ],
        'production' => [
            'adapter' => 'pgsql',
            'host' => getenv('DB_HOST') ?? 'localhost',
            'port' => getenv('DB_PORT') ?? 5432, // optional
            'username' => getenv('DB_USER') ?? 'root',
            'password' => getenv('DB_PASSWORD') ?? '',
            'db_name' => getenv('DB_NAME') ?? 'SDGP',
            'charset' => getenv('DB_CHARSET') ?? 'utf8mb4',
            'collation' => getenv('DB_COLLATION') ?? 'utf8mb4_general_ci', // optional, if not set default collation for utf8mb4 is used
        ],
    ],
    'default_environment' => getenv('APP_ENV') ?? 'local',
    'log_table_name' => 'phoenix_log',
];