<?php
require_once __DIR__."/../../config.php";

$sql  = "SELECT DISTINCT Livre.*
FROM Livre
LEFT OUTER JOIN Type_Livre ON Livre.ISBN = Type_Livre.isbn_livre 
LEFT OUTER JOIN Categorie_Livre ON Livre.ISBN = Categorie_Livre.isbn_livre
WHERE (Categorie_Livre.id_categorie = :categorie OR :categorie_value = 0) 
AND (Type_Livre.id_type = :type OR :type_value = 0)
AND `Accepte`='Oui'";


$stmt = $pdo->prepare($sql);

if (isset($categorie)) {
    $stmt->bindParam(":categorie", $categorie);
    $stmt->bindValue(":categorie_value", $categorie);
}
if (isset($type)) {
    $stmt->bindParam(":type", $type);
    $stmt->bindValue(":type_value", $type);
}
$stmt->execute();

$livres = $stmt->fetchAll(PDO::FETCH_ASSOC);


    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($livres);
    exit;

?>