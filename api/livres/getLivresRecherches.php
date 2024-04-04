<?php
require_once __DIR__."/../../config.php";

if(isset($motCle) && filter_var($motCle, FILTER_VALIDATE_INT)){
    $stmt = $pdo->prepare("SELECT * FROM `Livre` 
    WHERE upper(Livre.titre) like upper('%'||$motCle||'%')
    ");
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