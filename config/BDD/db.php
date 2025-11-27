<?php
$host     = '54.38.84.29';
$port     = 3306;
$dbname   = 'error404';
$username = 'jeff';
$password = 'jeff';

$dsn = "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4";

try {
    $pdo = new PDO($dsn,$username,$password,[
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ]);
}catch (Throwable $error){
    http_response_code(500);
    echo "ERREUR BDD : " . $error->getMessage();
    exit;
}