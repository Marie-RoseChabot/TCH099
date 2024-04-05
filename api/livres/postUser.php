<?php
require_once __DIR__."/../../config.php";
$message="";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $prenom = $_POST['prenom'] ?? '';

    $nom = $_POST['nom'] ?? '';
    $courriel = $_POST['courriel'] ?? '';
    $dateNaissance = $_POST['dateNaissance'] ?? '';
    $username = $_POST['username'] ?? '';
    $password = $_POST['motDePasse'] ?? '';
    $typeUsager = $_POST['typeCompte'] ?? '';
    $confirmPass = $_POST['confirmerMdp'] ?? '';
    echo $nom . " " . $courriel . " " . $dateNaissance . " " . $username . " " . $password . " " . $typeUsager;    
    // Vérifier si toutes les données sont fournies
    if (!empty($prenom) && !empty($nom) && !empty($courriel) && !empty($dateNaissance) && !empty($username) && !empty($password) && !empty($typeUsager)) {

        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare('INSERT INTO Usager (`username`, `password`, `courriel`, `nom`, `prenom`, `date_naissance`, `type_usager`) VALUES (?, ?, ?, ?, ?, ?, ?)');
        if ($stmt->execute([$username, $passwordHash, $courriel, $nom, $prenom, $dateNaissance, $typeUsager])) {
            header("Location: login.php");
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
echo $nom . " " . $courriel . " " . $dateNaissance . " " . $username . " " . $password . " " . $typeUsager;    
echo $message;
?>
