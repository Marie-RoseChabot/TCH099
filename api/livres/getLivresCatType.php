<?php
require_once __DIR__."/../../config.php";

// Check if either $categorie or $type is provided and not equal to '-'
if ((isset($categorie) && $categorie !== "-") || (isset($type) && $type !== "-")) {
    // Construct a SQL query to filter by category and/or type if provided
    $sql = "SELECT * 
            FROM Livre
            JOIN Type_Livre ON Livre.ISBN = Type_Livre.ISBN 
            JOIN Categorie_Livre ON Livre.ISBN = Categorie_Livre.ISBN
            WHERE ";
    
    $conditions = [];
    if (isset($categorie) && $categorie !== "-") {
        $conditions[] = "Categorie_Livre.categorie = :categorie";
    }
    if (isset($type) && $type !== "-") {
        $conditions[] = "Type_Livre.type = :type";
    }
    
    $sql .= implode(" AND ", $conditions);
    
    $stmt = $pdo->prepare($sql);
    
    // Bind parameters if they are provided
    if (isset($categorie) && $categorie !== "-") {
        $stmt->bindParam(":categorie", $categorie);
    }
    if (isset($type) && $type !== "-") {
        $stmt->bindParam(":type", $type);
    }
} else {
    // If neither $categorie nor $type is provided, fetch all books without filtering
    $stmt = $pdo->prepare("
        SELECT * 
        FROM Livre
    ");
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

