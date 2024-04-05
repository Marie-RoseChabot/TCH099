<?php
require_once __DIR__."/../../config.php";
echo($user);
if(isset($user) ){
    $stmt = $pdo->prepare("SELECT COUNT(username) as count FROM `Usager` WHERE `username`=:user");
    $stmt->bindParam(":user", $user);
    $stmt->execute();

    $userCount = $stmt->fetch(PDO::FETCH_ASSOC);
    $count = $userCount['count'];
} else {
    $count = 0; 
}


echo json_encode([$count]);