<?php

require __DIR__ . '/vendor/autoload.php';

$db = include __DIR__ . 'config/db.php';

[
    'driver' => $driver,
    'host' => $host,
    'port' => $port,
    'database' => $dataBase,
    'username' => $userName,
    'password' => $password,
    'charset' => $charset,
    'collation' => $collation
] = $db;

return [
    'paths' => [
        'migrations' => [
            __DIR__. '/db/migrations'
        ],
        'seeds' => [
            __DIR__ . '/db/seeds'
        ]
    ],
    'environments' => [
        'default_migration_table' => 'migrations',
        'default_database' => 'development',
        'development' => [
            'adapter' => $driver,
            'host' => $host,
            'name' => $dataBase,
            'pass' => $password,
            'charset' => $charset,
            'collation' => $collation
        ]
    ]
];
?>