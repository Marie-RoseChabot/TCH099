<?php
require_once __DIR__."/../../config.php";


if(isset($motCle)){
    
    $stmt = $pdo->prepare("SELECT * FROM Livre 
    LEFT OUTER JOIN Auteur ON Livre.id_auteur = Auteur.id
    WHERE (UPPER(Livre.titre) LIKE UPPER(CONCAT('%',:motCle,'%'))
    OR UPPER(CONCAT(Auteur.prenom, ' ', Auteur.nom)) LIKE UPPER(CONCAT('%',:motCle2,'%'))
    OR UPPER(Auteur.nom) LIKE UPPER(CONCAT('%',:motCle3,'%'))
    OR UPPER(Auteur.prenom) LIKE UPPER(CONCAT('%',:motCle4,'%'))
    OR UPPER(Livre.isbn) LIKE UPPER(CONCAT('%',:motCle5,'%')))");


    
    $stmt->bindParam(":motCle", $motCle,PDO::PARAM_STR);
    $stmt->bindParam(":motCle2", $motCle,PDO::PARAM_STR);
    $stmt->bindParam(":motCle3", $motCle,PDO::PARAM_STR);
    $stmt->bindParam(":motCle4", $motCle,PDO::PARAM_STR);
    $stmt->bindParam(":motCle5", $motCle,PDO::PARAM_STR);

    $stmt->execute();

    $livres = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    $livres = ["error" => "invalide"];
}

header('Content-Type: application/json; charset=utf-8');
echo json_encode($livres);
?>