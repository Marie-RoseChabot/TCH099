<?php
require_once __DIR__."/../../config.php";

if (isset($isbn)) {
    $stmt->bindParam(":isbn", $isbn);
}
$stmt = $pdo->prepare('SELECT * FROM Critique WHERE `isbn`=:isbn');
$stmt->execute();


$critiques = $stmt->fetchAll();

header('Content-Type: application/json; charset=utf-8');
echo json_encode($critiques);

?>
