<?php
require_once __DIR__.'/config.php';
$error = '';
if($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $_POST['username'];
  $password = $_POST['motDePasse'];
  
  if(str_contains($username, "@")){
    $stmtEmail = $pdo->prepare('SELECT * FROM Usager WHERE courriel = ? AND password = PASSWORD(?)');
    $stmtEmail->execute([$username,$password]);
    $user = $stmtEmail->fetch();
  } else {
    $stmtUsername = $pdo->prepare('SELECT * FROM Usager WHERE username = ? AND password = PASSWORD(?)');
    $stmtUsername->execute([$username,$password]);
    $user = $stmtUsername->fetch();
  }


  if($user){
    $_SESSION['usager'] = $user['username'];
    $_SESSION['type'] = $user['type_usager'];
    $connecte = 1;
    header("Location: /index.php");
    exit;
  } else {
    $error = "Nom d'utilisateur ou mot de passe invalide.";
  }

  echo "Erreur : " . $error;

}

?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="style.css" />
    <title>Connexion</title>
  </head>
  <body>
    <main id="mainLogin">
      <form id="formLogin" class="formulaires" action="./login.php" method="post">
        <h2>Identifiez-vous</h2>
        <!-- Si l'utilisateur entre son email, ça devrait quand même fonctionner -->
        <label for="username">Nom d'utilisateur : </label>
        <input type="text" name="username" id="username" required/>
        <label for="motDePasse">Mot de passe : </label>
        <input type="password" name="motDePasse" id="motDePasse" required/>
        <input
          type="submit"
          name="btnConnexion"
          id="btnConnexion"
          value="Se connecter"
        />      
        <div class="inscrire, basPageLogin">Vous n'avez pas de compte ? Inscrivez-vous <a href="./register.php">ici</a>!
        <div class="basPageLogin"><a href="./index.php">Retour au catalogue</a></div>
      </form>

      </div>
      <div class="background"></div>
    </main>
  </body>
</html>
