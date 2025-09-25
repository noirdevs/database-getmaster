<?php

return [ 'default' => 'mysql', 
    'connections' => [

        'mysql' => [
            'driver'   => 'mysql',
            'host'     => '127.0.0.1',
            'port'     => '3306/3308',
            'database' => 'db_',
	    'table'    => 'dbo.table',
            'username' => 'root',
            'password' => 'password_mysql',
            'charset'  => 'utf8mb4',
        ],
        
        'pgsql' => [
            'driver'   => 'pgsql',
            'host'     => '127.0.0.1',
            'port'     => '5432',
            'database' => 'postgres',
	    'table'    => 'public.table',
            'username' => 'postgres',
            'password' => 'password_pgsql',
        ],

        'mssql' => [ 
	    'driver' => 'sqlsrv', 
	    'host' => 'alamat_server_mssql', 
	    'port' => '1433/49xxx', 
	    'database' => 'db_', 
	    'table'    => 'dbo.table',
	    'username' => 'sa', 
	    'password' => 'password_mssql',
        ],

        'sqlite' => [
            'driver'   => 'sqlite',
            'database' => __DIR__ . '/var/www/log.db', 
        ],

    ]
];
