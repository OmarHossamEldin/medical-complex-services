<?php

return [
    //If you need to connect with the service name instead of tns, you can use the configuration below:
    'oracle' => [
        'driver' => 'oracle',
        'host' =>  env('DB_HOST_SECOND'),
        'port' => env('DB_PORT_SECOND','1521'),
        'database' => env('DB_DATABASE_SECOND'),
        'service_name' => env('DB_SERVICENAME_SECOND'),
        'username' =>  env('DB_USERNAME_SECOND'),
        'password' =>  env('DB_PASSWORD_SECOND'),
        'server_version' => env('DB_SERVER_VERSION2', '11g'),
        'charset' => '',
        'prefix' => '',
    ],
    // If you need to connect with the tns instead of service name, you can use the configuration below:
    // 'oracleTns' => [
    //     'driver'         => 'oracle',
    //     'tns'            => env('DB_TNS2', ''),
    //     'host'           => env('DB_HOST2', ''),
    //     'port'           => env('DB_PORT2', '1521'),
    //     'database'       => env('DB_DATABASE2', ''),
    //     'username'       => env('DB_USERNAME2', ''),
    //     'password'       => env('DB_PASSWORD2', ''),
    //     'charset'        => env('DB_CHARSET2', 'AL32UTF8'),
    //     'prefix'         => env('DB_PREFIX2', ''),
    //     'prefix_schema'  => env('DB_SCHEMA_PREFIX2', ''),
    //     'edition'        => env('DB_EDITION2', 'ora$base'),
    //     'server_version' => env('DB_SERVER_VERSION2', '11g'),
    // ],
];
