<?php
require_once __DIR__.'/config.php';
$gPublic = true;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $prenom = $_POST['prenom'];
    $nom = $_POST['nom'];
    $isbn_livre = $_POST["isbn"];
    $titre = $_POST["titre"];
    $maison_edition = $_POST["maison_edition"];
    $annee = $_POST["annee"];
    $url_image = $_POST["url_image"];
    $description = $_POST["description_livre"];
    $categorie = $_POST["categorie"];
    $type = $_POST["type"];
    $date = date('Y-m-d', time());

    $stmt = $pdo->prepare("SELECT id FROM `Auteur` WHERE `nom`=:nom AND `prenom`=:prenom");
    $stmt->bindValue(":nom", $nom);
    $stmt->bindValue(":prenom", $prenom);
    $stmt->execute();

    if($stmt->rowCount() > 0) {
        $id_auteur = $stmt->fetchColumn();
    } else {
        $id_auteur = null;
    }

    $stmt = $pdo->prepare('INSERT INTO Demande (`date_demande`, `id_auteur`, `annee`, `maison_edition`, `isbn_livre`, `titre`, `url_image`, `description`, `type`, `categorie`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
    if ($stmt->execute([$date, $id_auteur, $annee, $maison_edition, $isbn_livre, $titre, $url_image, $description, $type, $categorie])) {
        header("Location: index.php");
        exit;
    } else {
       echo 'Erreur lors de la création de la demande';
    }
}
?>

<!DOCTYPE html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="style.css" />
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" />
<title>Ajout de livre</title>
</head>
<body>
<main id="mainAjout">
    <form id="formAjout" method="post">
        <label for="isbn">ISBN : </label>
        <input type="number" name="isbn" id="isbn"><br>
        <label for="titre">Titre : </label>
        <input type="text" name="titre" id="titre"><br>
        <label for="maison_edition">Maison d'édition : </label>
        <input type="text" name="maison_edition" id="maison_edition"><br>
        <label for="nom">Nom d'auteur : </label>
        <input type="text" name="nom" id="nom"><br>
        <label for="prenom">Prénom d'auteur : </label>
        <input type="text" name="prenom" id="prenom"><br>
        <label for="annee">Année : </label>
        <input type="number" name="annee" id="annee"><br>
        <label for="url_image">Image du livre : </label>
        <input type="url" name="url_image" id="url_image"><br>
        <label for="description_livre">Description : </label>
        <textarea name="description_livre" id="description_livre" rows="4" cols="50">
            Description ici!
        </textarea><br>
        <label for="type">Type : </label>
        <select name="type" id="type">
            <option value="">Veuillez choisir un type de livre</option>
            <option value="albums">Albums</option>
            <option value="bd">Bande dessinée</option>
            <option value="contes">Contes</option>
            <option value="documentaire">Documentaire</option>
            <option value="journaux">Journaux</option>
            <option value="magazines">Magazines</option>
            <option value="mangas">Mangas</option>
            <option value="nouvelles">Nouvelles</option>
            <option value="philosophie">Philosophie</option>
            <option value="poesie">Poésie</option>
            <option value="romans">Romans</option>
        </select><br>
        <label for="categorie">Catégorie : </label>
        <select name="categorie" id="categorie">
        <option value="">Veuillez choisir une catégorie</option>
            <option value="aventure">Aventure</option>
            <option value="biographique">Biographique</option>
            <option value="jeunesse">Jeunesse</option>
            <option value="fantastique">Fantastique</option>
            <option value="historique">Historique</option>
            <option value="policier">Policier</option>
            <option value="romance">Romance</option>
            <option value="science-fiction">Science-Fiction</option>
            <option value="horreur">Horreur</option>
            <option value="suspense">Suspense</option>
            <option value="action">Action</option>
            <option value="tragedie">Tragédie</option>
            
        </select>
        <input type="hidden" name="type_usager" value="editeur">
        <button type="submit" id="soumettre">Soumettre</button>
        <a href = "./index.php"><button type="button" id="quit">Quitter</button></a>
    </form>
    <div class="background"></div>
</main>
<!--<script type="text/javascript" src="./script.js">
    initDemande();
</script>-->
</body>