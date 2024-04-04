<?php
require_once __DIR__."/../../config.php";

if(isset($id) && filter_var($id, FILTER_VALIDATE_INT)){
    $stmt = $pdo->prepare("SELECT * FROM `Auteur` WHERE `id`=:id");
    $stmt->bindParam(":id", $id);
    $stmt->execute();

    $auteur = $stmt->fetch();
} else {
    $auteur = ["error"=>"Code id invalide"];
}


if($lauteur){
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($livre);
    exit;
}