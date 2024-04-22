<?php

// Démarrage de la session
session_start();



require_once dirname(__FILE__) . "/vendor/php-jwt/JWTExceptionWithPayloadInterface.php";
require_once dirname(__FILE__) . "/vendor/php-jwt/BeforeValidException.php";
require_once dirname(__FILE__) . "/vendor/php-jwt/CachedKeySet.php";
require_once dirname(__FILE__) . "/vendor/php-jwt/ExpiredException.php";
require_once dirname(__FILE__) . "/vendor/php-jwt/JWK.php";
require_once dirname(__FILE__) . "/vendor/php-jwt/JWT.php";
require_once dirname(__FILE__) . "/vendor/php-jwt/Key.php";
require_once dirname(__FILE__) . "/vendor/php-jwt/SignatureInvalidException.php";


global $API_SECRET;
$API_SECRET = "MaCleSecrete123!"; 

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

if(isset($_SESSION["usager"])) {
    $gUserId = $_SESSION["usager"];
} else {
    $gUserId = 0;
}
if (isset($_POST["critique"])) {
    $userid;
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

function authentifier(){
    global $API_SECRET;

    if(isset($_SESSION["user_id"])){
        return $_SESSION["user_id"];
         }
    if(isset($_SESSION["usager"])) {
        return $_SESSION["usager"];
    }
    //On récupère toutes les entêtes de la requête
    $headers = getallheaders();
    //On s'intéresse spécifiquement à l'entête Authorization
    //Cette dernière comporte le mot clé Bearer suivi du Token. 
    //On enlève le mode "Bearer " pour ne conserver que la chaine de caractères du Token
    $jwt = str_replace('Bearer ', '', $headers['Authorization'] ?? '');

    //On décode le Token
    try {
        $decoded = JWT::decode($jwt, new Key($API_SECRET, 'HS256'));
        // Si le token est valide, on retourne l'id de l'usager qui a été stocké dans le Token
        return $decoded->user_id;
    } catch (\Firebase\JWT\ExpiredException $e) {
        // Gérer l'expiration du token
        throw new Exception('Token expiré!');
    } catch (\Exception $e) {
        // Gérer les autres erreurs
        throw new Exception('Erreur de token: '.$e->getMessage());
    }
}
?>