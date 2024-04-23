<?php
require_once __DIR__."/../../config.php";

if(!isset($_SERVER["CONTENT_TYPE"]) || $_SERVER["CONTENT_TYPE"]!='application/json; charset=utf-8'){
    http_response_code(400);
    exit;
}

//Obtenir le corps de la requête
$body = json_decode(file_get_contents("php://input"));

if(!isset($body->titre) || $body->titre == ""){
    http_response_code(401);
    echo "Le titre est obligatoire";
    exit;
}

if(isset($body->prenom)&&isset($body->nom)){
    $stmt = $pdo->prepare("SELECT id FROM `Auteur` WHERE `nom`=:nom AND `prenom`=:prenom");
    $stmt->bindValue(":nom", $body->nom);
    $stmt->bindValue(":prenom", $body->prenom);
    $stmt->execute();

    if($stmt->rowCount() > 0) {
        $id_auteur = $stmt->fetchColumn();
    } else {
        $id_auteur = null;
    }

}

try{
    $stmt = $pdo->prepare("INSERT INTO `Livre` (`isbn`, `titre`, `maison_edition`, `annee`, `url_image`, `description_livre`, `id_auteur`,`accepte`) VALUES (:isbn, :titre, :maison_edition, :annee, :url_image, :description_livre, :id_auteur,'Non')");
    $stmt->bindValue(":isbn", $body->isbn);
    $stmt->bindValue(":titre", $body->titre);
    $stmt->bindValue(":maison_edition", $body->maison_edition);
    $stmt->bindValue(":annee", $body->annee);
    $stmt->bindValue(":url_image", $body->url_image);
    $stmt->bindValue(":description_livre", $body->description_livre);
    $stmt->bindValue(":id_auteur", $id_auteur);
    $stmt->execute();

    $insertion = ["isbn"=>$body->isbn, "titre"=>$body->titre, "maison_edition"=>$body->maison_edition, "annee"=>$body->annee, "url_image"=>$body->url_image, "description_livre"=>$body->description_livre, "id_auteur"=>$body->id_auteur];
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($insertion);
} catch (PDOException $e){
    http_response_code(500);
    echo "Erreur lors de l'insertion en BD: ".$e->getMessage();
}


