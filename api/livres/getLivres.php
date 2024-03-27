<?php
require_once __DIR__."/../../config.php";
$stmt = $pdo->prepare("SELECT * FROM `Livre`");
$stmt->execute();

$livres = $stmt->fetchAll();

header('Content-Type: application/json; charset=utf-8');
echo json_encode($livres);
