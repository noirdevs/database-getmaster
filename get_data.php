<?php

$date = date('Y-m-d', strtotime("-1 days")); 
$path = "/home/datawp";
$filename = $date . ".txt";
$config = require_once 'config.php';
require_once 'DatabaseManager.php';

DatabaseManager::setConfig($config);

echo "Memulai proses pengambilan data untuk tanggal" . $date ."\n";

try {
    $db_name = 'mysql';
    $pdo = DatabaseManager::getConnection($db_name);

    $tableName = $config['connections'][$db_name]['table'];

    echo "Mengambil data dari tabel '{$tableName}' untuk tanggal {$date}...\n";

    $sql = "SELECT transaksi_id, tanggal_transaksi, subtotal, service(jikaada), tax FROM {$tableName} WHERE tanggal_transaksi LIKE ?";
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['%' . $date . '%']);

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($results) {
        echo "Terdapat " . count($results) . " struk.\n";

	$string = '';

	foreach ($results as $struk) {
		$baris .= implode('|', $struk) . "\n";
	}
        echo "Data akan disimpan di " . $path . "/NEW/" . $filename ."\n";

	if (!is_dir(dirname($pathLengkap))) {
            mkdir(dirname($pathLengkap), 0755, true);
        }

	file_put_contents($pathLengkap, $string_output);

    } else {
        echo $date . "Tidak ada data"."\n";
    }


} catch (Exception $e) {
    echo "\n!!! ERROR GAISSS !!!\n";
    echo "Pesan: " . $e->getMessage() . "\n";
}
