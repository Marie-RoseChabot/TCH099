<?php
require_once __DIR__.'/config.php';

$stmt = $pdo->prepare('SELECT * FROM Livre');
$stmt->execute();
$livres = $stmt->fetchAll();

$stmt = $pdo->prepare('SELECT * FROM Auteur');
$stmt->execute();
$auteurs = $stmt->fetchAll();

$stmt = $pdo->prepare('SELECT * FROM Categorie_Livre');
$stmt->execute();
$categorieLivre = $stmt->fetchAll();

$stmt = $pdo->prepare('SELECT * FROM Categorie');
$stmt->execute();
$categorie = $stmt->fetchAll();

$stmt = $pdo->prepare('SELECT * FROM Type_Livre');
$stmt->execute();
$typeLivre = $stmt->fetchAll();

$stmt = $pdo->prepare('SELECT * FROM Type');
$stmt->execute();
$type = $stmt->fetchAll();

$livresJson = json_encode($livres);
$auteursJson = json_encode($auteurs);
$categorieLivreJson = json_encode($categorieLivre);
$categorieJson = json_encode($categorie);
$typeLivreJson = json_encode($typeLivre);
$typeJson = json_encode($type);
?>
<!DOCTYPE html>
<head>
  <meta charset="utf-8" />
  <link rel="stylesheet" href="style.css" />
  <title>CabinÉTS</title>
  <script>
      var listeLivre = <?= $livresJson ?>;
      var listeAuteur = <?= $auteursJson ?>;
      var categorieLivre = <?= $categorieLivreJson ?>;
      var listeCategorie = <?= $categorieJson ?>;
      var typeLivre = <?= $typeLivreJson ?>;
      var listeType = <?= $typeJson ?>;
    </script>
</head>
<body class="conteneur">
    <header class="entete">
        <!--<img src="./img/logo.png" alt=logo>-->
        CabinÉTS
    </header>
    <div class="onglet">

        <p><a href="./index.php">Catalogue</a></p>
        
        <?php
        // Ce qui s'affiche si l'utilisateur est connecté
        if(isset($_SESSION["usager"])){
            if($_SESSION["type"] == "employe"){
                echo "<p><a href = './portailEmploye.php'>Portail Employé</a></p>";
            } else if($_SESSION["type"] == "editeur") {
                echo "<p><a href= './demandeAjout.php'>Demande d'ajout de livre</a></p>";
            }
            echo "<p>Réserver</p>";
            echo '<a href = "./index.php?deconnexion"> Se déconnecter</a>';
        }
        

        // Ce qui s'affiche s'il n'est pas connecté
        else{
            echo"<p><a href = './login.php'>Se connecter</a></p>";
            echo "<p><a href = './register.php'>S'inscrire</a></p>";
        }
        ?>
        <p><input type="text" id="recherche" placeholder="Recherche"><button type="submit" id="submitRecherche">Soumettre</button></p>

    </div>
    <nav class="type">
        <h3>Type de document</h3>
        <ul id="filtreType"></ul>
    </nav>
    <main class="principal">
        <h2 id="filtreCategorie">Catalogue
            <span class="fleche">></span>
            <span class="headerCategorie">Catégorie</span>
        </h2>
        <div class="background" id="parchemin"></div>
        <p id="desc"></p>
        <button id="btnCritique" style="display: none"></button>
        <button id="btnReservation" style="display: none"></button>
        <?php
            if (!isset($_SESSION["usager"])) {
                echo "<script>const permission = false;</script>";
            } else {
                echo "<script>const permission = true;</script>";
            }
        ?>
        <dialog id="dialogCritique">
            <form method="post">
            <h5 id="critiqueh5">Donnez votre avis sur le livre</h5>
            <p>Veuillez donner votre avis entre 1 et 5 étoiles</p>
            <div class="rating">
                <img src="/img/blankStar.png" class="star" data-value="1">
                <img src="/img/blankStar.png" class="star" data-value="2">
                <img src="/img/blankStar.png" class="star" data-value="3">
                <img src="/img/blankStar.png" class="star" data-value="4">
                <img src="/img/blankStar.png" class="star" data-value="5">
                <input type="hidden" name="etoiles" id="etoiles"/>
                <input type="hidden" />
            </div>
            <label for="critique">Veuillez donner votre avis écrit</label>
            <textarea id="critique" name="critique" rows="2" cols="50"></textarea>
            <button id="fermerDialog">Fermer</button>
            <button id="envoyerCritique" type="submit">Envoyer</button>
            </form>
        </dialog>
        <section class="affichageCritiques" style="display: none"><h5 class="baliseTitreCritiques">Évaluations</h5><div class="divCritiques"></div></section>
        <div class="background" id="parchemin"></div>
    </main>
    <footer class="bas">
        <strong>© 2024 - Équipe E</strong>
    </footer>
    <script type="text/javascript" src="./script.js"></script>
    <link rel="stylesheet" href="style.css" />
    <script>
        afficherLivre(listeLivre);
        afficherType(listeType);
        afficherCategorie(listeCategorie);
        scrollCategorie();
        initButtons();
        initRecherche();
        //initDemande();
    </script>
    <!--<script>
      let estEditeur = <php echo $permission; ?> ; 
    </script>
    <script type="text/javascript" src="./scripts.js" defer async></script>-->
</body>
