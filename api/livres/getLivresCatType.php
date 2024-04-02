<?php
require_once __DIR__."/../../config.php";

if(isset($categorie) && isset($type)){
    $stmt = $pdo->prepare("
        SELECT * 
        FROM Livre
        JOIN Type_Livre ON Livre.ISBN = Type_Livre.ISBN 
        JOIN Categorie_Livre ON Livre.ISBN = Categorie_Livre.ISBN
        WHERE (:categorie = '-' OR Categorie_Livre.categorie = :categorie)
        AND (:type = '-' OR Type_Livre.type = :type)
    ");

    $stmt->bindParam(":categorie", $categorie);
    $stmt->bindParam(":type", $type);
    $stmt->execute();

    $livre = $stmt->fetch();
} else {
    $livre = ["error" => "Code ISBN invalide"];
}
if($livre){
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($livre);
    exit;
} else {
    header("HTTP/1.0 404 Not Found");
    exit;
}
