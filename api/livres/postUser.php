<?php
require_once __DIR__."/../../config.php";

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

 // Insérer le nouvel utilisateur
 $stmt = $pdo->prepare('INSERT INTO Usager (`username`, `password`, `courriel`, `nom`, `prenom`, `date_naissance`, `type_usager`) VALUES (?, ?, ?, ?, ?, ?, ?)');
 if ($stmt->execute([$username, $passwordHash, $courriel, $nom, $prenom, $dateNaissance, $typeUsager])) {
     header("Location: login.php");
     exit;
 } else {
     $message = 'Erreur lors de la création du compte.';
 }
?>
