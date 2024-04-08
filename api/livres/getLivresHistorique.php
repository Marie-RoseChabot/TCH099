<?php
require_once __DIR__."/../../config.php";

try {
    $userid = authentifier();
} catch(Exception $e) {
    $response = [];
    http_response_code(401);
    $response['error'] = "Non autorisé";
    echo json_encode($response);
    exit;
}

$stmt = $pdo->prepare('SELECT Livre.titre, Livre.url_image,Emprunt.date_emprunt
FROM Emprunt
LEFT OUTER JOIN Copie ON Copie.id_copie = Emprunt.id_copie
LEFT OUTER JOIN Livre ON Livre.isbn = Copie.isbn_livre
');
$stmt->execute();

$livres = $stmt->fetchAll();

header('Content-Type: application/json; charset=utf-8');
echo json_encode($livres);

?>