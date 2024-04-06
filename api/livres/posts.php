<?php

require_once __DIR__."/../config.php";

$userid = 0;

try{
    $userid = authentifier();
} catch(Exception $e){
    $response = [];
    http_response_code(401);
    $response['error'] = "Non autorisé";
    echo json_encode($response);
}

$response = [];
//Ici la réponse est créée à la main, mais on peut imaginer que les informations
//proviennent de la BD
$response[0] = ['date'=>'2024-04-25 16:10:05', 'contenu'=>'Ceci est un exemple de post'];
$response[1] = ['date'=>'2024-04-25 17:20:21', 'contenu'=>'Ceci est un autre post'];

http_response_code(200);
echo json_encode($response);
?>