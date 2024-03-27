<?php
require_once __DIR__.'/config.php';
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- Saisir le lien du css ici -->
    <title>Connexion</title>
  </head>
  <body>
    <main>
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
      </form>
      <div class="inscrire">Vous n'avez pas de compte ? Inscrivez-vous <a href="./register.php">ici</a>!
      </div>
    </main>
  </body>
</html>
