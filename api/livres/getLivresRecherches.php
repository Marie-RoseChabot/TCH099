<?php
require_once __DIR__."/../../config.php";

if(isset($motCle)){
    $motCle = "%$motCle%";
    $stmt = $pdo->prepare("SELECT * FROM Livre 
    LEFT OUTER JOIN Auteur ON Livre.id_auteur = Auteur.id
    WHERE (UPPER(Livre.titre) LIKE UPPER(:motCle)
    OR UPPER(CONCAT(Auteur.prenom, ' ', Auteur.nom)) LIKE UPPER(:motCle) 
    OR UPPER(Auteur.nom) LIKE UPPER(:motCle) 
    OR UPPER(Auteur.prenom) LIKE UPPER(:motCle) 
    OR UPPER(Livre.isbn) LIKE UPPER(:motCle))");
    $stmt->bindParam(":motCle", $motCle, PDO::PARAM_STR);
    $stmt->execute();

    $livres = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    $livres = ["error" => "invalide"];
}

header('Content-Type: application/json; charset=utf-8');
echo json_encode($livres);
?>
