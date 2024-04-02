<?php
require_once __DIR__."/../../config.php";

$conditions = [];


if (isset($categorie) && $categorie !== "-") {
    $conditions[] = "Categorie_Livre.id_categorie = :categorie"; 
}

if (isset($type) && $type !== "-") {
    $conditions[] = "Type_Livre.id_type = :type"; 
}

$sql = "SELECT * 
        FROM Livre
        JOIN Type_Livre ON Livre.ISBN = Type_Livre.isbn_livre 
        JOIN Categorie_Livre ON Livre.ISBN = Categorie_Livre.isbn_livre";

if (!empty($conditions)) {
    $sql .= " WHERE " . implode(" AND ", $conditions);
}


$stmt = $pdo->prepare($sql);


if (isset($categorie) && $categorie !== "-") {
    $stmt->bindParam(":categorie", $categorie);
}
if (isset($type) && $type !== "-") {
    $stmt->bindParam(":type", $type);
}

$stmt->execute();


$livres = $stmt->fetchAll(PDO::FETCH_ASSOC);


if ($livres) {
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($livres);
    exit;
} else {
    header("HTTP/1.0 404 Not Found");
    exit;
}
?>
