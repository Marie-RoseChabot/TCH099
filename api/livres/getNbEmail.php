<?php
require_once __DIR__."/../../config.php";

if(isset($email) ){
    $stmt = $pdo->prepare("SELECT COUNT(email) FROM `usager` WHERE `email`=:email");
    $stmt->bindParam(":email", $email);
    $stmt->execute();

    $emailCount = $stmt->fetch();
} else {
    $emailCount = ["error"=>"Code ISBN invalide"];
}


if($emailCount){
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($emailCount);
    exit;
} else {
    echo json_encode("AUCUN");
    exit;
}

