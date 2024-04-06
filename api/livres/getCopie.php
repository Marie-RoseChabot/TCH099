<?php
require_once __DIR__."/../../config.php";

if(isset($isbn) ){
    $stmt = $pdo->prepare("SELECT COUNT(id_copie) as count FROM `Copie` WHERE `isbn_livre`=:isbn"
    AND `est_dispo`=1);
    $stmt->bindParam(":isbn", $isbn);
    $stmt->execute();

    $copieCount = $stmt->fetch(PDO::FETCH_ASSOC);
    $count = $copieCount['count'];
} else {
    $count = 0; 
}


echo json_encode([$count]);