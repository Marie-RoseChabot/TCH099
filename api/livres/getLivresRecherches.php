<?php
require_once __DIR__."/../../config.php";

$motCle = isset($_GET['motCle']) ? $_GET['motCle'] : null;

if($motCle !== null ){
    
    $stmt = $pdo->prepare("SELECT * FROM `Livre` WHERE UPPER(Livre.titre) LIKE ?");
    
    $motCle = '%' . $motCle . '%';
    
    $stmt->bindValue(1, $motCle, PDO::PARAM_STR);
    $stmt->execute();

    $livres = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Vérifiez si aucun livre correspondant n'a été trouvé
    if (empty($livres)) {
        $livres = ["error" => "Aucun livre trouvé pour le mot-clé spécifié"];
    }
} else {
    $livres = ["error" => "Mot-clé invalide"];
}

// Envoyer la réponse en JSON
header('Content-Type: application/json; charset=utf-8');
echo json_encode($livres);
