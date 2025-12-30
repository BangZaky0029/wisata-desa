<?php
error_reporting(E_ALL);
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    $conn = new mysqli('localhost', 'root', '', 'wisata_desa_db');
    $conn->set_charset('utf8mb4');
    
    $result = $conn->query('SHOW TABLES');
    
    if ($result) {
        echo "📊 TABEL YANG TERSEDIA:\n";
        echo "=======================\n";
        
        while ($row = $result->fetch_row()) {
            echo "✓ " . $row[0] . PHP_EOL;
        }
        
        echo "=======================\n";
        echo "✅ Database Connection: OK\n";
    } else {
        echo "❌ NO TABLES FOUND\n";
    }
    
    $conn->close();
} catch (Throwable $e) {
    echo "❌ ERROR: " . $e->getMessage() . PHP_EOL;
    exit(1);
}
?>