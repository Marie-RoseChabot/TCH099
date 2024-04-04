<?php
require_once __DIR__."/../../config.php";

$motCle = isset($_GET['motCle']) ? $_GET['motCle'] : null;

if ($motCle !== null) {
    // Validation du mot-clé
    if (is_string($motCle) && strlen($motCle) > 0) {
        // Préparation de la requête SQL avec un placeholder pour le mot-clé
        $stmt = $pdo->prepare("SELECT * FROM `Livre` WHERE UPPER(Livre.titre) LIKE ?");
        
        // Formatage du mot-clé avec des caractères de joker %
        $motCle = '%' . $motCle . '%';

        // Lier le mot-clé à la placeholder dans la requête préparée
        $stmt->bindParam(1, $motCle, PDO::PARAM_STR);
        
        // Exécution de la requête
        $stmt->execute();

        $livres = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($livres) {
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($livres);
            exit;
        } else {
            
            $livres = ["error" => "Aucun livre trouvé pour le mot-clé spécifié"];
        }
    } else {
        $livres = ["error" => "Mot-clé invalide"];
    }
} else {
    $livres = ["error" => "Mot-clé non spécifié"];
}

header('Content-Type: application/json; charset=utf-8');
echo json_encode($livres);
exit;
?>
