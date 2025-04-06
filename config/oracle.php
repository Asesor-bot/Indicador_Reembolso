<?php

return [
    #sico
    'sico' => [
    'driver'         => 'oracle',
    'host'           => env('DB_HOST', ''),
    'port'           => env('DB_PORT', '1521'),
    'database'       => env('DB_DATABASE', ''),
    'service_name'   => env('DB_SERVICE_NAME', ''),
    'username'       => env('DB_USERNAME', ''),
    'password'       => env('DB_PASSWORD', ''),
    'charset'        => env('DB_CHARSET', 'AL32UTF8'),
    'prefix'         => env('DB_PREFIX', ''),
    'prefix_schema'  => env('DB_SCHEMA_PREFIX', ''),
    'edition'        => env('DB_EDITION', 'ora$base'),
    'server_version' => env('DB_SERVER_VERSION', '11g'),
    'load_balance'   => env('DB_LOAD_BALANCE', 'yes'),
    'dynamic'        => [],
    'max_name_len'   => env('ORA_MAX_NAME_LEN', 30),
    ],
    #renato
    #'oracle2' => [
    #    'driver'         => 'oracle',
    #    'host'           => env('DB_HOST2', ''),
    #    'port'           => env('DB_PORT2', '1521'),
    #    'database'       => env('DB_DATABASE2', ''),
    #    'service_name'   => env('DB_SERVICE_NAME2', ''),
    #    'username'       => env('DB_USERNAME2', ''),
    #    'password'       => env('DB_PASSWORD2', ''),
    #    'charset'        => env('DB_CHARSET2', 'AL32UTF8'),
    #    'prefix'         => env('DB_PREFIX2', ''),
    #    'prefix_schema'  => env('DB_SCHEMA_PREFIX2', ''),
    #    'edition'        => env('DB_EDITION2', 'ora$base'),
    #    'server_version' => env('DB_SERVER_VERSION2', '11g'),
    #    'load_balance'   => env('DB_LOAD_BALANCE2', 'yes'),
    #    'dynamic'        => [],
    #    'max_name_len'   => env('ORA_MAX_NAME_LEN2', 30),
    #],
];
