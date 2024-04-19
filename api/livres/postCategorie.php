<?php
require_once __DIR__."/../../config.php";

if(!isset($_SERVER["CONTENT_TYPE"]) || $_SERVER["CONTENT_TYPE"]!='application/json; charset=utf-8'){
    http_response_code(400);
    exit;
}

$body = json_decode(file_get_contents("php://input"));

try {
    $stmt = $pdo->prepare("INSERT INTO `Categorie_Livre` (`isbn_livre`, `id_categorie`) VALUES (:isbn, :id_categorie)");
    $stmt->bindValue(":isbn", $body->isbn);
    $stmt->bindValue(":id_categorie", $body->id); 
    $stmt->execute();

    $insertion = ["isbn" => $body->isbn, "id_categorie" => $body->id];
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($insertion);
} catch (PDOException $e) {
    http_response_code(500);
    echo "Erreur lors de l'insertion en BD: " . $e->getMessage();
}
?>
