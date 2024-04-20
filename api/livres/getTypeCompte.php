<?php

require_once __DIR__."/../../config.php";

$userid = 0;

try {
    $userid = authentifier();
} catch(Exception $e) {
    $response = [];
    http_response_code(401);
    $response['error'] = "Non autorisé";
    echo json_encode($response);
    exit;
}

$stmt = $pdo->prepare('SELECT type_usager FROM Usager 
WHERE username=:userid');
$stmt->bindParam(':userid', $userid);
$stmt->execute();

$typeCompte = $stmt->fetch();

header('Content-Type: application/json; charset=utf-8');
echo json_encode($typeCompte);