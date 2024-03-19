<?php
session_start();
$host =  parse_url($_SERVER["HTTP_HOST"], PHP_URL_HOST);
if($host=="localhost" || $host=="equipe305.tch099.ovh"){
    //Code d'accès à la base de données locale
    $host = 'db';
    $db   = 'mydatabase';
    $user = 'user';
    $pass = 'password';
} else {
    //Codes d'accès à la base de données de production
        Host: 'localhost';
        BD: 'equipe305';
        User: 'equipe305';
        Password: '7RZ3x9HUSQcQZ9Wq';
}
$charset = 'utf8mb4';
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
 
 
try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}
?>