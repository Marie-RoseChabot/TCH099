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
        if(isset($connecte) && $connecte != 0){
            echo "<p>Réserver</p>";
            echo "<p>Se déconnecter</p>";
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
        <dialog id="dialogDescription"><p id="description"></p>
        </dialog>
        <div class="background" id="parchemin"></div>
    </main>
    <footer class="bas">
        <strong>© 2024 - Équipe E</strong>
    </footer>
    <script type="text/javascript" src="./script.js"></script>
    <script>
        afficherLivre(listeLivre);
        afficherType(listeType);
        afficherCategorie(listeCategorie);
        scrollCategorie();
    </script>
</body>
