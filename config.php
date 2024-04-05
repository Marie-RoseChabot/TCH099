<?php

// Démarrage de la session
session_start();

require_once __DIR__."C:\Users\Dell\Documents\Uni\Bac\Session4\projet\Web\TCH099/vendor\php_jwt/JWTExceptionWithPayloadInterface.php";
require_once __DIR__."/vendor/php-jwt/BeforeValidException.php";
require_once __DIR__."/vendor/php-jwt/CachedKeySet.php";
require_once __DIR__."/vendor/php-jwt/ExpiredException.php";
require_once __DIR__."/vendor/php-jwt/JWK.php";
require_once __DIR__."/vendor/php-jwt/JWT.php";
require_once __DIR__."/vendor/php-jwt/Key.php";
require_once __DIR__."/vendor/php-jwt/SignatureInvalidException.php";


global $API_SECRET;
$API_SECRET = "MaCleSecrete123!"; 

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

if(isset($_SESSION["usager"])) {
    $gUserId = $_SESSION["usager"];
} else {
    $gUserId = 0;
}

if(isset($_GET["deconnexion"])){
    unset($_SESSION["usager"]);
    header("Location: index.php");
    $gPublic = 1;
    exit;
}
$host =  parse_url($_SERVER["HTTP_HOST"], PHP_URL_HOST);
if($host=="localhost"){
    //Code d'accès à la base de données locale
    $host = 'db';
    $db   = 'mydatabase';
    $user = 'user';
    $pass = 'password';
} else {
    //Codes d'accès à la base de données de production
        $host = 'localhost';
        $db = 'equipe305';
        $user = 'equipe305';
        $pass = '7RZ3x9HUSQcQZ9Wq';
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