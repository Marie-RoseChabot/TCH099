<?php
require_once __DIR__."/../../config.php";


$motCle = isset($_GET['motCle']) ? $_GET['motCle'] : null;

if($motCle !== null ){
    
    $stmt = $pdo->prepare("SELECT * FROM `Livre` WHERE UPPER(Livre.titre) LIKE ?");
    
    $motCle = '%' . $motCle . '%';
    
    
    $stmt->bindValue(1, $motCle, PDO::PARAM_STR);
    $stmt->execute();

    $livres = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    $livres = ["error" => "invalid keyword"];
}

header('Content-Type: application/json; charset=utf-8');
echo json_encode($livres);
