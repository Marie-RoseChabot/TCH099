<?php
require_once __DIR__."/../../config.php";

if(!isset($_SERVER["CONTENT_TYPE"]) || $_SERVER["CONTENT_TYPE"]!='application/json; charset=utf-8'){
    http_response_code(400);
    exit;
}

$body = json_decode(file_get_contents("php://input"));


if(isset($body->type)){
    $stmt = $pdo->prepare("SELECT id_type FROM `Categorie` WHERE  `nom`=:type");
    $stmt->bindValue(":type", $body->type);
    
    $stmt->execute();

    if($stmt->rowCount() > 0) {
        $id_type = $stmt->fetchColumn();
    } else {
        $id_type = null;
    }
}


try{
    $stmt = $pdo->prepare("INSERT INTO `Type_Livre` (`isbn_livre`,`id_type` ) VALUES (:isbn, :id_type"));
    $stmt->bindValue(":isbn", $body->isbn);
    $stmt->bindValue(":id_type", $id_type);
    $stmt->execute();

    $insertion = ["isbn"=>$body->isbn, "id_type"=>$id_type];
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($insertion);
}
catch (PDOException $e){
    http_response_code(500);
    echo "Erreur lors de l'insertion en BD: ".$e->getMessage();
}