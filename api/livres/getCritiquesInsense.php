<?php
require_once __DIR__."/../../config.php";
    $stmt = $pdo->prepare("SELECT * FROM `Critique` WHERE `est_signale`='oui'");
    $stmt->execute();
    $critiquesInsense = $stmt->fetchAll(PDO::FETCH_ASSOC);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($critiquesInsense);

?>
