<?php
require_once __DIR__."/../../config.php";

if(isset($email) ){
    $stmt = $pdo->prepare("SELECT COUNT(courriel) as count FROM `Usager` WHERE `courriel`=:email");
    $stmt->bindParam(":email", $email);
    $stmt->execute();

    $emailCount = $stmt->fetch(PDO::FETCH_ASSOC);
    $count = $emailCount['count'];
} else {
    $count = 0; 
}


echo json_encode(["count" => $count]);
