<?php

require_once __DIR__."/../../config.php";

$userid = 0;

try {
    $userid = authentifier();
} catch(Exception $e) {
    $response = [];
    http_response_code(400);
    $response['error'] = "Non autorisé";
    echo json_encode($response);
    exit;
}

$body = json_decode(file_get_contents("php://input"));

try{
    $stmt = $pdo->prepare("INSERT INTO Critique 
    (etoiles, commentaire, est_signale, username_client, isbn) 
SELECT 
    :etoiles, 
    :commentaire, 
    'Non', 
    :user, 
    Livre.isbn 
FROM 
    Livre 
WHERE 
    Livre.titre = :titre
");
    $stmt->bindValue(":etoiles", $body->note);
    $stmt->bindValue(":titre",$body->titre);
    $stmt->bindValue(":commentaire",$body->critique);
    $stmt->bindValue(":user",$userid);
    $stmt->execute();

    $insertion = ["note"=>$body->note, "critique"=>$body->critique, "titre"=>$body->titre];
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($insertion);
} catch (PDOException $e){
    http_response_code(500);
    echo "Erreur lors de l'insertion en BD: ".$e->getMessage();
}
