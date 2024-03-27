<?php
require_once __DIR__."/../../config.php";

if(isset($isbn) && filter_var($isbn, FILTER_VALIDATE_INT)){
    $stmt = $pdo->prepare("SELECT * FROM `Livre` WHERE `isbn`=:isbn");
    $stmt->bindParam(":isbn", $isbn);
    $stmt->execute();

    $livre = $stmt->fetch();
} else {
    $livre = ["error"=>"Identifiant invalide"];
}

if($livre){
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($livre);
    exit;
} else {
    header("HTTP/1.0 404 Not Found");
    exit;
}

