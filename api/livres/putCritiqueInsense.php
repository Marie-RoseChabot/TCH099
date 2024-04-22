<?php
require_once __DIR__."/../../config.php";

echo($_SERVER["CONTENT_TYPE"]);
if(!isset($_SERVER["CONTENT_TYPE"]) || $_SERVER["CONTENT_TYPE"]!='application/json;'){
    http_response_code(400);
    exit;
}

if(isset($id)) {

    $stmt = $pdo->prepare("UPDATE `Critique` SET `est_signale`='non' WHERE `id_critique`=:id");
    $stmt->bindValue(":id", $id);
    $stmt->execute();

    if ($stmt->execute()) {
        echo json_encode(array('success' => true, 'message' => 'Signalement status updated successfully'));
    } else {
        echo json_encode(array('success' => false, 'message' => 'Failed to update signalement status'));
    }
} else {
    echo json_encode(array('success' => false, 'message' => 'ISBN not provided'));
}




