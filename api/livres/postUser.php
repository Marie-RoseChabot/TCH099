<?php
require_once __DIR__."/../../config.php";

if (!isset($_SERVER["CONTENT_TYPE"]) || $_SERVER["CONTENT_TYPE"] != 'application/json') {
    http_response_code(400);
    exit;
}

$body = json_decode(file_get_contents("php://input"));

try {
    $stmt = $pdo->prepare("INSERT INTO `Usager` (`username`, `password`, `courriel`, `nom`, `prenom`, `date_naissance`, `type_usager`) 
    VALUES (:username, :mdp, :courriel, :nom, :prenom, :dateNaissance, 'client')");

    $stmt->bindParam(':username', $body->username);
    $stmt->bindParam(':mdp', $body->password);
    $stmt->bindParam(':courriel', $body->courriel);
    $stmt->bindParam(':nom', $body->nom);
    $stmt->bindParam(':prenom', $body->prenom);
    $stmt->bindParam(':dateNaissance', $body->dateNaissance);

    $stmt->execute();

    header('Content-Type: application/json; charset=utf-8');
    echo json_encode(["success" => true]);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(["error" => "Erreur lors de l'insertion en BD: " . $e->getMessage()]);
}
?>
