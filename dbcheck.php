<?php
error_reporting(E_ALL);
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
try {
     = new mysqli('localhost', 'root', '', 'wisata_desa_db');
    ->set_charset('utf8mb4');
     = ->query('SHOW TABLES');
    if () {
        while ( = ->fetch_row()) {
            echo [0] . PHP_EOL;
        }
        echo 'OK';
    } else {
        echo 'NO TABLES';
    }
    ->close();
} catch (Throwable ) {
    echo 'ERROR: ' . ->getMessage();
    exit(1);
}
