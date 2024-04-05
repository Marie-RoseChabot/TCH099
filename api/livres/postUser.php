<?php
require_once __DIR__."/../../config.php";
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $prenom = $_POST['prenom'];
    $nom = $_POST['nom'];
    $courriel = $_POST['courriel'];
    $dateNaissance = $_POST['dateNaissance'];
    $username = $_POST['username'];
    $password = $_POST['motDePasse'];
    $typeUsager = $_POST['typeCompte'];
    $confirmPass = $_POST['confirmerMdp'];

    // Hasher le mot de passe
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    // Préparer la requête SQL
    $stmt = $pdo->prepare('INSERT INTO Usager (`username`, `password`, `courriel`, `nom`, `prenom`, `date_naissance`, `type_usager`) 
                            VALUES (?, ?, ?, ?, ?, ?, ?)');
    
    // Exécuter la requête SQL
    if ($stmt->execute([$username, $passwordHash, $courriel, $nom, $prenom, $dateNaissance, 'client'])) {
        header("Location: login.php");
        exit;
    } else {
        $message = 'Erreur lors de la création du compte.';
    }
}

echo $message;
?>
