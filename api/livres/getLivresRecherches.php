<?php
require_once __DIR__."/../../config.php";

$motCle = isset($_GET['motCle']) ? $_GET['motCle'] : null;

if(isset($motCle) ){
    $stmt = $pdo->prepare("SELECT * FROM `Livre` 
    WHERE upper(Livre.titre) like upper('%'||$motCle||'%')");
    $stmt->bindParam(":motCle", $motCle);
    $stmt->execute();

    $livre = $stmt->fetchAll();
} else {
    $livre = ["error"=>"invalide"];
}


if($livre){
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($livre);
    exit;
}