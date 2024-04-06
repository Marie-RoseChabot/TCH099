<?php
require_once __DIR__."/../../config.php";
use Firebase\JWT\JWT;

if(!isset($_SERVER["CONTENT_TYPE"]) || $_SERVER["CONTENT_TYPE"]!='application/json'){
    http_response_code(400);
    exit;
}

//Obtenir le corps de la requête
$body = json_decode(file_get_contents("php://input"));

$response = [];

if(!isset($body->username) || $body->username == "" || !isset($body->password) || $body->password == "" ){
    http_response_code(401);
    $response["error"] = "Informations d'authentification incorrectes";
    echo json_encode($response);
    exit;
}


$user = false;

try{
    $stmt = $pdo->prepare("SELECT `username` FROM `Usager` WHERE `username`=:username AND `password`=PASSWORD(:password)");
    $stmt->bindValue(":username", $body->username);
    $stmt->bindValue(":password", $body->password);
    $stmt->execute();

    $user = $stmt->fetch();

} catch (PDOException $e){
    http_response_code(500);
    $response['error'] =  "BD non disponible: ".$e->getMessage();
    echo json_encode($response);
    exit;
}


if($user){
    $payload = [
        "iss" => "https://equipe305.tch099.ovh", // Émetteur du token
        "aud" => "https://equipe305.tch099.ovh", // Audience du token
        "iat" => time(), // Temps où le JWT a été émis
        "exp" => time() + 3600, // Expiration du token (1 heure plus tard)
        "user_id" => $user['username'],
        "user_name" => $body->username,
    ];

    $jwt = JWT::encode($payload, $API_SECRET, 'HS256'); // Génère le token
    $response['message'] = "Authentification réussie";
    $response['token'] = $jwt;

    http_response_code(200);
    echo json_encode($response);
} else {
    http_response_code(401);
    $response['error'] = "Non autorisé";
    echo json_encode($response);
}

?>