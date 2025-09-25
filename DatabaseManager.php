<?php

class DatabaseManager
{
    private static array $config = [];
    private static array $connections = [];

    private function __construct() {}

    public static function setConfig(array $config): void
    {
        self::$config = $config;
    }

    public static function getConnection(?string $name = null): PDO
    {
        $name = $name ?? self::$config['default'];

        if (isset(self::$connections[$name])) {
            return self::$connections[$name];
        }

        return self::connect($name);
    }

    private static function connect(string $name): PDO
    {
        $config = self::$config['connections'][$name] ?? null;

        if (!$config) {
            throw new InvalidArgumentException("Konfigurasi database '$name' tidak ditemukan.");
        }

        $dsn = self::buildDsn($config);

        try {
            $pdo = new PDO($dsn, $config['username'] ?? null, $config['password'] ?? null);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            self::$connections[$name] = $pdo;
            return $pdo;

        } catch (PDOException $e) {
            throw new PDOException("Gagal terhubung ke database '$name': " . $e->getMessage());
        }
    }

    private static function buildDsn(array $config): string
    {
        $driver = $config['driver'];
        
        switch ($driver) {
            case 'mysql':
                return "mysql:host={$config['host']};port={$config['port']};dbname={$config['database']};charset={$config['charset']}";
            case 'pgsql':
                return "pgsql:host={$config['host']};port={$config['port']};dbname={$config['database']}";
            case 'sqlsrv':
                return "sqlsrv:Server={$config['host']},{$config['port']};Database={$config['database']}";
            case 'sqlite':
                return "sqlite:{$config['database']}";
            default:
                throw new InvalidArgumentException("Driver database '$driver' tidak didukung.");
        }
    }
}
