<?php
require_once __DIR__."/../../config.php";


if(isset($motCle)){
    $motCleParam = "%$motCle%";
    $stmt = $pdo->prepare("SELECT * FROM Livre 
    left outer JOIN Auteur on Livre.id_auteur=Auteur.id
    WHERE (upper(Livre.titre) like upper(:motCle)
    OR UPPER(CONCAT(Auteur.prenom, ' ', Auteur.nom)) LIKE UPPER(:motCle) 
    OR upper(Auteur.nom) like upper(:motCle) 
    OR upper(Auteur.prenom) like upper(:motCle) 
    OR upper(Livre.isbn) like upper(:motCle))");
    $stmt->bindParam(":motCle", $motCleParam);
    $stmt->bindParam(":motCle", $motCleParam);
    $stmt->execute();

    $livres = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    $livres = ["error" => "invalide"];
}

header('Content-Type: application/json; charset=utf-8');
echo json_encode($livres);
?>
