<?php
require_once __DIR__."/../../config.php";


if(isset($motCle)){
    $motCleParam = "%$motCle%";
    $stmt = $pdo->prepare("SELECT * FROM Livre 
    
    WHERE (upper(Livre.titre) like upper(:motCle)
   ");
    $stmt->bindParam(":motCle", $motCleParam);
    $stmt->execute();

    $livres = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    $livres = ["error" => "invalide"];
}

header('Content-Type: application/json; charset=utf-8');
echo json_encode($livres);
?>