<?php

return [
    'app' => [
        'session_save_path' => '/cache/session',
        'view_path' => '/views'
    ],
    'database' => [
        'driver' => 'pgsql',
        'host' => 'localhost',
        'port' => 5432,
        'user' => 'postgres',
        'password' => '',
        'dbname' => 'framework'
    ],
];