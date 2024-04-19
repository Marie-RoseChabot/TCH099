<?php
require_once __DIR__."/../../config.php";
$stmt = $pdo->prepare("SELECT * FROM Livre WHERE `Accepte`='Oui'");
$stmt->execute();

$livres = $stmt->fetchAll();

header('Content-Type: application/json; charset=utf-8');
echo json_encode($livres);
