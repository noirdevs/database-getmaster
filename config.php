<?php

require_once __DIR__ '/vendor/autoload.php'

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

return [ 'default' => 'mysql', 
    'connections' => [

        'mysql' => [
            'driver'   => 'mysql',
            'host'     => $_ENV['DB_HOST'] ?? '127.0.0.1',
            'port'     => $_ENV['DB_PORT'] ?? '3306/3308',
            'database' => $_ENV['DB_DATABASE'] ?? 'db_',
	    'table'    => $_ENV['DB_TABLE'] ?? 'dbo.table',
            'username' => $_ENV['DB_USERNAME'] ?? 'root',
            'password' => $_ENV['DB_PASSWORD'] ?? 'password_mysql',
            'charset'  => 'utf8mb4',
        ],
        
        'pgsql' => [
            'driver'   => 'pgsql',
            'host'     => $_ENV['PG_HOST'] ?? '127.0.0.1',
            'port'     => $_ENV['PG_PORT'] ?? '5432',
            'database' => $_ENV['PG_DATABASE'] ?? 'postgres',
	    'table'    => $_ENV['PG_TABLE'] ?? 'public.table',
            'username' => $_ENV['PG_USERNAME'] ?? 'postgres',
            'password' => $_ENV['PG_PASSWORD'] ?? 'password_pgsql',
        ],

        'mssql' => [ 
	    'driver' => 'sqlsrv', 
	    'host' => $_ENV['SS_HOST'] ?? 'alamat_server_mssql', 
	    'port' => $_ENV['SS_PORT'] ?? '1433/49xxx', 
	    'database' => $_ENV['SS_DATABASE'] ?? 'db_', 
	    'table'    => $_ENV['SS_TABLE'] ?? 'dbo.table',
	    'username' => $_ENV['SS_USERNAME'] ?? 'sa', 
	    'password' => $_ENV['SS_PASSWORD'] ?? 'password_mssql',
        ],

        'sqlite' => [
            'driver'   => 'sqlite',
	    'database' => __DIR__ . '/' . ($_ENV['SQLITE_DATABASE'] ?? 'database.sqlite'),
        ],

    ]
];
