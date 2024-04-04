<?php
require_once __DIR__ . "/../../config.php";

$motCle = isset($_GET['motCle']) ? $_GET['motCle'] : null;

$response = [];

if ($motCle !== null) {

    $sql = "SELECT * FROM `Livre` WHERE UPPER(titre) LIKE :motCle";
    $stmt = $pdo->prepare($sql);
    $motCleParam = '%' . strtoupper($motCle) . '%'; 
    $stmt->bindParam(':motCle', $motCleParam, PDO::PARAM_STR);
    
    // Exécuter la requête
    if ($stmt->execute()) {
        $livres = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        if (!empty($livres)) {
            $response = ["livres" => $livres];
        } else {
            $response = ["message" => "Aucun livre trouvé pour le mot-clé spécifié"];
        }
    } else {
        $response = ["error" => "Erreur lors de l'exécution de la requête SQL"];
    }
} else {
    $response = ["error" => "Paramètre de recherche 'motCle' non spécifié dans l'URL"];
}

header('Content-Type: application/json; charset=utf-8');
echo json_encode($response);
exit;
?>
