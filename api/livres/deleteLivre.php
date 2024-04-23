<?php
require_once __DIR__."/../../config.php";

try{

    $stmt= $pdo->prepare("DELETE FROM `Livre` WHERE `isbn`=:isbn");
    $stmt->bindValue(":isbn", $isbn);
    $stmt->execute();

    if(!$stmt->rowCount()){
        http_response_code(400);
        echo "Identifiant de critique invalide.";
        exit;
    }

    $reponse = ["response"=>"OK"];
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($reponse);
} catch (PDOException $e){
    http_response_code(500);
    echo "Erreur lors de l'insertion en BD: ".$e->getMessage();
}
