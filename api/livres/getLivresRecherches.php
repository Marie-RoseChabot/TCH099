<?php
require_once __DIR__."/../../config.php";

if(isset($motCle)){
    $stmt = $pdo->prepare("SELECT * FROM `Livre` 
    
    WHERE upper(Titre) like upper('%'||$motCle||'%');");
    $stmt->bindParam(":motCle", $motCle);
    $stmt->execute();

    $livre = $stmt->fetch();
} else {
    $livre = ["error"=>"invalide"];
}


if($livre){
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($livre);
    exit;
}