<?php
require_once __DIR__."/../../config.php";
$stmt = $pdo->prepare('SELECT * FROM Auteur');
$stmt->execute();

$auteur = $stmt->fetchAll();

header('Content-Type: application/json; charset=utf-8');
echo json_encode($auteur);
