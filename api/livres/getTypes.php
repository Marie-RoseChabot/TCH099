<?php
require_once __DIR__."/../../config.php";
$stmt = $pdo->prepare('SELECT * FROM Type');
$stmt->execute();

$types = $stmt->fetchAll();

header('Content-Type: application/json; charset=utf-8');
echo json_encode($types);
