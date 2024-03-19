<?php
require_once __DIR__.'/config.php';

$stmt = $pdo->prepare('SELECT * FROM Livre');
$stmt->execute();
$livres = $stmt->fetchAll();

$livresJson = json_encode($livres);
?>
<!DOCTYPE html>
<head>
  <meta charset="utf-8" />
  <link rel="stylesheet" href="style.css" />
  <title>CabinÉTS</title>
  <script>
      var listeLivre = <?= $livresJson ?>;
    </script>
</head>
<body class="conteneur">
    <header class="entete">
        <!--<img src="./img/logo.png" alt=logo>-->
        CabinÉTS
    </header>
    <div class="onglet">
        <ul>
            <li><a href="./index.php">Catalogue</a></li>
            <li>Réserver</li>
            <li>Se connecter / S'inscrire</li>
            <li><input type="text" id="recherche" placeholder="Recherche"><button type="submit" id="submitRecherche">Soumettre</button></li>
        </ul>
    </div>
    <nav class="categorie">
        <h3>Type de document</h3>
        <ul id="filtreType"></ul>
        <h3>Catégorie</h3>
        <ul id="filtreCategorie"></ul>
    </nav>
    <main class="principal">
        <h2>Catalogue</h2>
        <div class="background" id="parchemin"></div>
    </main>
    <footer class="bas">
        <strong>© 2024 - Équipe E</strong>
    </footer>
    <script type="text/javascript" src="./script.js"></script>
</body>