<?php
require_once __DIR__."/../../config.php";
echo($username);
if(isset($username) ){
    $stmt = $pdo->prepare("SELECT COUNT(username) as count FROM `Usager` WHERE `username`=:username");
    $stmt->bindParam(":username", $username);
    $stmt->execute();

    $userCount = $stmt->fetch(PDO::FETCH_ASSOC);
    $count = $userCount['count'];
} else {
    $count = 0; 
}


echo json_encode([$count]);