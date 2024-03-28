<?php
require_once __DIR__."/../../config.php";

if(!isset($_SERVER["CONTENT_TYPE"]) || $_SERVER["CONTENT_TYPE"]!='application/json'){
    http_response_code(400);
    exit;
}

//Obtenir le corps de la requête
$body = json_decode(file_get_contents("php://input"));

if(!isset($body->isbn) || $body->isbn == ""){
    http_response_code(400);
    echo "Le code ISBN est obligatoire";
    exit;
}

if(!isset($body->title) || $body->title == ""){
    http_response_code(400);
    echo "Le titre est obligatoire";
    exit;
}

if(!isset($body->maison_edition) || $body->maison_edition == ""){
    http_response_code(400);
    echo "La maison d'édition est obligatoire";
    exit;
}

if(!isset($body->annee) || $body->annee == ""){
    http_response_code(400);
    echo "L'année est obligatoire";
    exit;
}

if(!isset($body->url_image) || $body->url_image == ""){
    http_response_code(400);
    echo "L'url est obligatoire";
    exit;
}

if(!isset($body->description_livre) || $body->description_livre == ""){
    http_response_code(400);
    echo "La description du livre est obligatoire";
    exit;
}

if(!isset($body->id_auteur) || $body->id_auteur == ""){
    http_response_code(400);
    echo "L'identifiant d'auteur est obligatoire";
    exit;
}

try{

    $stmt= $pdo->prepare("SELECT `isbn` FROM `Livre` WHERE `isbn`=:isbn");
    $stmt->bindValue(":isbn", $isbn);
    $stmt->execute();

    if(!$stmt->rowCount()){
        http_response_code(400);
        echo "Code ISBN invalide.";
        exit;
    }

    $stmt = $pdo->prepare("UPDATE `Livre` SET `titre`=:titre, `annee`=:annee, `url_image`=:url_image, `description_livre`=:description_livre, WHERE `isbn`=:isbn AND `maison_edition`=:maison_edition");
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


