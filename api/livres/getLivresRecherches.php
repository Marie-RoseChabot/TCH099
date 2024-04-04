<?php
require_once __DIR__."/../../config.php";


if(isset($motCle)){
    
    $stmt = $pdo->prepare("SELECT * FROM Livre 
    
    WHERE (upper(Livre.titre) like upper(CONCAT('%',:motCle,'%')))
    OR (upper(Livre.titre) like upper(CONCAT('%',:motCle,'%')))");

    $stmt->bindParam(":motCle", $motCle,PDO::PARAM_STR);
    $stmt->execute();

    $livres = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    $livres = ["error" => "invalide"];
}

header('Content-Type: application/json; charset=utf-8');
echo json_encode($livres);
?>