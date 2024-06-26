<?php
require_once __DIR__."/../../config.php";
$message="";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $body = json_decode(file_get_contents("php://input"));

    $prenom =$body->prenom;
    $nom = $body->nom;
    $courriel = $body->courriel;
    $dateNaissance = $body->dateNaissance;
    $username = $body->username;
    $password = $body->password;
    $typeUsager = $body->typeUsager;
   
   
    if (!empty($prenom) && !empty($nom) && !empty($courriel) && !empty($dateNaissance) && !empty($username) && !empty($password) && !empty($typeUsager)) {
        if($typeUsager == "editeur") {
            $stmt = $pdo->prepare('INSERT INTO Auteur (`nom`, `prenom`, `date_naissance`, `date_deces`) VALUES (?, ?, ?, NULL)');
            $stmt->execute([$nom, $prenom, $dateNaissance]);
        }

        $stmt = $pdo->prepare('INSERT INTO Usager (`username`, `password`, `courriel`, `nom`, `prenom`, `date_naissance`, `type_usager`) VALUES (?, PASSWORD(?), ?, ?, ?, ?, ?)');
        if ($stmt->execute([$username, $password, $courriel, $nom, $prenom, $dateNaissance, $typeUsager])) {
            header("Location: login.php");
            http_response_code(200);

            exit;
        } else {
            $message = 'Erreur lors de la création du compte.';
        }
    } else {
        $message = 'Veuillez fournir toutes les données requises.';
    }
} else {
    $message = 'La méthode de requête n\'est pas valide.';
}

echo $message;
?>
