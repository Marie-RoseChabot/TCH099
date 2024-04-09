<?php
require_once __DIR__."/../../config.php";

if(!isset($_SERVER["CONTENT_TYPE"]) || $_SERVER["CONTENT_TYPE"]!='application/json'){ 
    http_response_code(403);
    exit;
}

$body = json_decode(file_get_contents("php://input"));

if(!isset($body->commentaire) || $body->commentaire == ""){
    http_response_code(401);
    echo "L'avis est obligatoire";
    exit;
}

if(!isset($body->etoiles) || $body->etoiles == ""){
    http_response_code(402);
    echo "Le rating est obligatoire";
    exit;
}

try{
    /*$commentaire = $_POST[":avis"];
    $etoiles = $_POST[":etoiles"];*/

    $stmt = $pdo->prepare("INSERT INTO `Critique` (`etoiles`, `commentaire`, `est_signale`,
                        `id_client`) VALUES (:etoiles, :commentaire, 'non', '1')");
    $stmt->bindValue(":etoiles", $body->etoiles);
    $stmt->bindValue(":commentaire", $body->commentaire);
    $stmt->execute();

    http_response_code(200);
    $insertion = ["etoiles"=>$body->etoiles, "commentaire"=>$body->commentaire];
    header('Content-Type: application/json');
    echo json_encode($insertion);
} catch (PDOException $e){
    http_response_code(500);
    echo "Erreur lors de l'insertion en BD: ".$e->getMessage();
}

?>