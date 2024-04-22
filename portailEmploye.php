<?php
require_once __DIR__.'/config.php';

$stmt = $pdo->prepare('SELECT * FROM Critique LEFT JOIN Livre ON Critique.isbn_livre = Livre.isbn WHERE est_signale = "oui"');
$stmt->execute();
$critiques = $stmt->fetchAll();

$critiquesJson = json_encode($critiques);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Portail Employé(e)</title>
    <script>
        let critiques = <?= $critiquesJson ?>;
    </script>
</head>
<body>
    <div class="container">
        <h1>Bienvenue au Portail Employé(e)</h1>
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
        <p id="critiqueVide">Aucun critique incensée à vérifier!</p>

        <h2>Demandes d'ajout de livre</h2>
        <table class=demande>
            <thead>
                <tr>
                    <th>Titre</th>
                    <th>Auteur</th>
                    <th>Catégorie</th>
                    <th>Type</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
    </div>
    <script type="text/javascript" src="./script.js"></script>
    <script>renderCritiques();</script>
</body>
</html>