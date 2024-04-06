<?php
require_once __DIR__."/../../config.php";

$categorie = isset($categorie) ? $categorie : 0;
$type = isset($type) ? $type : 0;

$sql = "SELECT DISTINCT Livre.*
        FROM Livre
        LEFT OUTER JOIN Type_Livre ON Livre.ISBN = Type_Livre.isbn_livre 
        LEFT OUTER JOIN Categorie_Livre ON Livre.ISBN = Categorie_Livre.isbn_livre
        WHERE (Categorie_Livre.id_categorie = :categorie OR :categorie = 0)
        AND (Type_Livre.id_type = :type OR :type = 0)";

$stmt = $pdo->prepare($sql);

$stmt->bindParam(":categorie", $categorie);
$stmt->bindParam(":type", $type);

$stmt->execute();


$livres = $stmt->fetchAll(PDO::FETCH_ASSOC);

header('Content-Type: application/json; charset=utf-8');
echo json_encode($livres);
exit;
?>
