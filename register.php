<?php
require_once __DIR__.'/config.php';
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- Saisir le lien du css ici -->
    <title>Inscription</title>
  </head>
  <body>
    <main>
      <form id="formRegister" class="formulaires" action="./register.php" method="post">
        <h2>Entrez vos informations pour créer un compte</h2>
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
        <input type="password" name="motDePasse" id="motDePasse" required maxlength="25"/>
        <!-- API REST : si le mot de passe confirmé est différent, il faut empêcher l'utilisateur
        de poursuivre en générant une erreur. -->
        <label for="confirmerMdp">Confirmer votre mot de passe : </label>
        <input type="password" name="confirmerMdp" id="confirmerMdp" required maxlength="25"/>

        <input
          type="submit"
          name="btnInscription"
          id="btnInscription"
          value="S'inscrire"
        />
      </form>
      <div class="connecter">Vous avez déjà un compte ? Connectez-vous <a href="./login.php">ici</a>!
    </main>
    
    </div>
  </body>
</html>