<?php
require_once __DIR__.'/config.php';

$stmt = $pdo->prepare('SELECT * FROM Critique LEFT JOIN Livre ON Critique.isbn = Livre.isbn WHERE est_signale = "oui"');
$stmt->execute();
$critiques = $stmt->fetchAll();

$critiquesJson = json_encode($critiques);

$stmt = $pdo->prepare("SELECT * FROM Livre WHERE accepte = 'non'");
$stmt->execute();
$demandes = $stmt->fetchAll();

$demandesJson = json_encode($demandes);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="style.css" />
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" />
    <title>Portail Employé(e)</title>
    <script>
        let critiques = <?= $critiquesJson ?>;
        let demandes = <?= $demandesJson ?>;
    </script>
</head>
<body>
    <head id="headEmploye">
        <a href="./index.php">Retour au Catalogue</a>
        <h1>Bienvenue au Portail Employé(e)</h1>
    </head>
    <div class="containerEmploye">
        <?php
            echo "<p>Bonjour, " .$_SESSION['usager']. ". Voici les signalements et les demandes d'ajout</p>";
        ?>
    
        <h2>Signalements de critiques inappropriées</h2>
        <table class=critique>
            <thead>
                <tr>    
                    <th>Titre</th>
                    <th>Commentaire</th>
                    <th>Signalement</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
        <p id="critiqueVide">Aucune critique insensée à vérifier!</p>

        <h2>Demandes d'ajout de livre</h2>
        <table class=demande>
            <thead>
                <tr>
                    <th>Titre</th>
                    <th>Auteur</th>
                    <th>Année</th>
                <th>Description</th>
                <th>Catégorie</th>
                    <th>Type</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
    </div>
    <div class="background"></div>
    <script type="text/javascript" src="./script.js"></script>
    <script>
    renderCritiques();
    renderDemandes();
</script>
</body>
</html>