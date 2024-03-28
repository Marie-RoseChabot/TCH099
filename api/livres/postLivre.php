<?php
require_once __DIR__."/../../config.php";

if(!isset($_SERVER["CONTENT_TYPE"]) || $_SERVER["CONTENT_TYPE"]!='application/json'){
    http_response_code(400);
    exit;
}

//Obtenir le corps de la requête
$body = json_decode(file_get_contents("php://input"));

if(!isset($body->titre) || $body->titre == ""){
    http_response_code(400);
    echo "Le titre est obligatoire";
    exit;
}

try{
    $stmt = $pdo->prepare("INSERT INTO `Livre` (`isbn`, `titre`, `maison_edition`, `annee`, `url_image`, `description_livre`, `id_auteur`) VALUES (:isbn, :titre, :maison_edition, :annee, :url_image, :description_livre, :id_auteur)");
    $stmt->bindValue(":isbn", $body->isbn);
    $stmt->bindValue(":titre", $body->titre);
    $stmt->bindValue(":maison_edition", $body->maison_edition);
    $stmt->bindValue(":annee", $body->annee);
    $stmt->bindValue(":url_image", $body->url_image);
    $stmt->bindValue(":description_livre", $body->description_livre);
    $stmt->bindValue(":id_auteur", $body->id_auteur);
    $stmt->execute();

    $insertion = ["isbn"=>$body->isbn, "titre"=>$body->titre, "maison_edition"=>$body->maison_edition, "annee"=>$body->annee, "url_image"=>$body->url_image, "description_livre"=>$body->description_livre, "id_auteur"=>$body->id_auteur];
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($insertion);
} catch (PDOException $e){
    http_response_code(500);
    echo "Erreur lors de l'insertion en BD: ".$e->getMessage();
}


