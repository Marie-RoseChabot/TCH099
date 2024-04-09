<?php
require_once __DIR__.'/config.php';
$gPublic = true;

$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  // récupère valeurs du formulaire
  $prenom = $_POST['prenom'];
  $nom = $_POST['nom'];
  $courriel = $_POST['courriel'];
  $dateNaissance = $_POST['dateNaissance'];
  $username = $_POST['username'];
  $password = $_POST['motDePasse'];
  $typeUsager = $_POST['typeCompte'];
  $confirmPass = $_POST['confirmerMdp'];

  if($password == $confirmPass) {
    // Vérifier si l'utilisateur existe déjà
    $stmt = $pdo->prepare('SELECT * FROM Usager WHERE username = ?');
    $stmt->execute([$username]);
    if ($stmt->fetch()){
        $error = 'Ce nom d\'utilisateur est déjà pris.';
    } else {
        // Hasher le mot de passe
        //$passwordHash = password_hash($password, PASSWORD_DEFAULT);

        // Insérer le nouvel utilisateur
        $stmt = $pdo->prepare('INSERT INTO Usager (`username`, `password`, `courriel`, `nom`, `prenom`, `date_naissance`, `type_usager`) VALUES (?, PASSWORD(?), ?, ?, ?, ?, ?)');
        if ($stmt->execute([$username, $password, $courriel, $nom, $prenom, $dateNaissance, $typeUsager])) {
            header("Location: login.php");
            exit;
        } else {
            $message = 'Erreur lors de la création du compte.';
        }
      }
  } else {
        $message = 'Erreur lors de la confirmation du mot de passe.';
  }
  echo $message;
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- Saisir le lien du css ici -->
    <link rel="stylesheet" href="style.css" />
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" />
    <title>Inscription</title>
  </head>
  <body>
    <main id="mainRegister">
      <form id="formRegister" class="formulaires" action="./register.php" method="post">
        <h2 id="enteteRegister">Entrez vos informations pour créer un compte</h2>
        <select name="typeCompte" id="typeCompte">          
          <option value="">--Veuillez choisir le type de compte désiré--</option>
          <option value="client">Client</option>
          <option value="editeur">Éditeur</option>
          <option value="employe">Employé</option>
        </select>

        </select>
        <!-- Les champs prénom, nom, nom d'utilisateur et mot de passe sont required 
          et leur nombre de caractères maximal est 25 pour respecter la base de 
          données. Courriel n'est PAS REQUIRED (on peut changer s'il faut), mais ne 
          peut pas dépasser 50 caractères.-->
        <label for="prenom">Prénom : </label>
        <input type="text" name="prenom" id="prenom" required maxlength="25">
        <label for="nom">Nom : </label>
        <input type="text" name="nom" id="nom" required maxlength="25">
        <label for="courriel">Courriel : </label>
        <input type="email" name="courriel" id="courriel" maxlength="50">
        <label for="dateNaissance">Date de naissance : </label>
        <input type="date" name="dateNaissance" id="dateNaissance">
        <label for="username">Nom d'utilisateur : </label>
        <input type="text" name="username" id="username" required maxlength="25"/>
        <label for="motDePasse">Mot de passe : </label>
        <input type="password" name="motDePasse" id="motDePasse" required/>
        <!-- API REST : si le mot de passe confirmé est différent, il faut empêcher l'utilisateur
        de poursuivre en générant une erreur. -->
        <label for="confirmerMdp">Confirmer votre mot de passe : </label>
        <input type="password" name="confirmerMdp" id="confirmerMdp" required/>

        <input
          type="submit"
          name="btnInscription"
          id="btnInscription"
          value="S'inscrire"
        />
      <div class="connecter">Vous avez déjà un compte ? Connectez-vous <a href="./login.php"> ici </a> !
      <div><a href="./index.php">Retour au catalogue</a></div>
      </form>
      <div class="background"></div>
    </main>
    </div>
  </body>
</html>