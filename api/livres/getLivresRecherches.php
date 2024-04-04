<?php
require_once __DIR__."/../../config.php";


if(isset($motCle)){
    $motCleParam = "%$motCle%";
    $stmt = $pdo->prepare("SELECT * FROM Livre 
    left outer JOIN auteur on Livre.id_auteur=auteur.id
    WHERE (upper(livretitre) like upper(:motCle)
    OR UPPER(CONCAT(Auteur.prenom, ' ', Auteur.nom)) LIKE UPPER(:motCle) 
    OR upper(auteur.nom) like upper(:motCle) 
    OR upper(auteur.prenom) like upper(:motCle) 
    OR upper(livre.isbn) like upper(:motCle))");
    $stmt->bindParam(":motCle", $motCleParam);
    $stmt->execute();

    $livres = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    $livres = ["error" => "invalide"];
}

header('Content-Type: application/json; charset=utf-8');
echo json_encode($livres);
?>
