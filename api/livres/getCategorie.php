<?php
require_once __DIR__."/../../config.php";
$stmt = $pdo->prepare('SELECT * FROM Categorie');
$stmt->execute();

$categories = $stmt->fetchAll();

header('Content-Type: application/json; charset=utf-8');
echo json_encode($categories);
