<?php
require_once __DIR__."/../../config.php";
if(isset($isbn) && filter_var($isbn, FILTER_VALIDATE_INT)){
    $stmt = $pdo->prepare("SELECT * FROM `Critique` WHERE `isbn`=:isbn");
    $stmt->bindParam(":isbn", $isbn);
    $stmt->execute();

    $critiques = $stmt->fetch();
} else {
    $critiques = ["error"=>"Code ISBN invalide"];
}


if($critiques){
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($livre);
    exit;
} else {
    header("HTTP/1.0 404 Not Found");
    exit;
}

?>
