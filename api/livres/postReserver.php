<?php

require_once __DIR__."/../../config.php";

$userid = 0;

try {
    $userid = authentifier();
} catch(Exception $e) {
    $response = [];
    http_response_code(401);
    $response['error'] = "Non autorisé";
    echo json_encode($response);
    exit;
}

$body = json_decode(file_get_contents("php://input"));

$stmt = $pdo->prepare('SELECT id_copie FROM Copie WHERE `est_dispo`=1 AND `isbn_livre`=:isbn');
$stmt->bindValue(":isbn",$body->isbn);
$stmt->execute();

$copie = $stmt->fetch();

if(isset($copie) && $copie != null) {
    $stmt = $pdo->prepare('UPDATE Copie SET `est_dispo`=0 WHERE `id_copie`=:copie ' );
    $stmt->bindValue(":copie", $copie['id_copie']);

    $stmt->execute();

 
    $stmt = $pdo->prepare("INSERT INTO `Emprunt` (`date_emprunt`, `date_retour`, `username_client`, `id_copie`, `date_retour_reel`) VALUES (:date_emprunt, :date_retour, :username_client, :id_copie, :date_retour_reel)");
    $stmt->bindValue(":date_emprunt", $body->date_emprunt);
    $date_retour = date('Y-m-d', strtotime($body->date_emprunt . ' + 14 days'));
    $stmt->bindValue(":date_retour", $date_retour);
    $stmt->bindValue(":date_retour_reel", null);
    $stmt->bindValue(":username_client", $userid);
    $stmt->bindValue(":id_copie", $copie['id_copie']); 
    $stmt->execute();

    if (isset($_SERVER["user_id"])) {
        echo "OK";
    }
    http_response_code(200);
} else {
    echo "NOT ok";
    http_response_code(400);
}

?>
