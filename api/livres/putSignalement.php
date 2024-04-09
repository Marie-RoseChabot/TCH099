<?php
require_once __DIR__."/../../config.php";

if(isset($isbn)) {
    

    $stmt = $pdo->prepare("UPDATE Critique SET est_signale = 'Oui' WHERE isbn = :isbn");
    $stmt->bindValue(":isbn", $isbn);
    
    if ($stmt->execute()) {
        echo json_encode(array('success' => true, 'message' => 'Signalement status updated successfully'));
    } else {
        echo json_encode(array('success' => false, 'message' => 'Failed to update signalement status'));
    }
} else {
    echo json_encode(array('success' => false, 'message' => 'ISBN not provided'));
}
?>
