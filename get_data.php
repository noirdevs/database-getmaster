<?php

$config = require_once 'config.php';
require_once 'DatabaseManager.php';

DatabaseManager::setConfig($config);

echo "Memulai proses...\n";

try {
    $db_name = 'mysql';
    $pdo_mysql = DatabaseManager::getConnection($db_name);

    $tableName = $config['connections'][$db_name]['table'];
    $date = date('Y-m-d', strtotime("-1 days")); 

    echo "Mengambil data dari tabel '{$tableName}' untuk tanggal {$date}...\n";

    $sql = "SELECT transaksi_id, tanggal_transaksi, subtotal, service(jikaada), tax FROM {$tableName} WHERE tanggal_transaksi LIKE '{$date}%'";
    
    $stmt = $pdo_mysql->prepare($sql);
    $stmt->execute(['%' . $date . '%']);

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($results) {
        echo "Data berhasil ditemukan: " . count($results) . " baris.\n";
        print_r($results[0]); 
    } else {
        echo "Tidak ada data untuk tanggal tersebut.\n";
    }


} catch (Exception $e) {
    echo "\n!!! TERJADI ERROR !!!\n";
    echo "Pesan: " . $e->getMessage() . "\n";
}
