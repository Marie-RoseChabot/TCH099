<?php
require_once __DIR__.'/config.php';

// Vérification de l'authentification de l'utilisateur éditeur
try {
      $id = $_SESSION['id'];
    // Si l'utilisateur est un éditeur, nous continuons avec le traitement de la demande d'ajout de livre
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Récupération des données du formulaire
        $isbn = $_POST['isbn'];
        $titre = $_POST['titre'];
        $auteur = $_POST['auteur'];
        $annee = $_POST['annee'];
        $urlImage = $_POST['urlImage'];
        $description = $_POST['description'];
        $type = $_POST['type'];
        $categorie = $_POST['categorie'];
        

        // Insertion des données dans la base de données (exemple)
        $stmt = $pdo->prepare('INSERT INTO Demande (`date_demande`, `id_auteur`, `annee`, `isbn_livre`, `titre`, `url_image`, `description`, `type`, `categorie`) VALUES (CURRENT_DATE(), ?, ?, ?, ?, ?, ?, ?, ?)');
        $stmt->execute([$id, $annee, $isbn, $titre, $urlImage, $description, $type, $categorie]);

        exit;
    }

} catch (Exception $e) {
    // En cas d'erreur lors de l'authentification ou de toute autre exception, nous renvoyons une réponse d'erreur
    $response = array(
        "success" => false,
        "message" => "Erreur lors de la demande d'ajout de livre : " . $e->getMessage()
    );
    echo json_encode($response);
    exit;
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
    <form action="./demandeAjout.php" id="formAjout" method="post">
        <label for="isbn">ISBN : </label>
        <input type="number" name="isbn" id="isbn"><br>
        <label for="titre">Titre : </label>
        <input type="text" name="titre" id="titre"><br>
        <label for="auteur">Auteur : </label>
        <input type="text" name="auteur" id="auteur"><br>
        <label for="annee">Année : </label>
        <input type="number" name="annee" id="annee"><br>
        <label for="urlImage">Image du livre : </label>
        <input type="url" name="urlImage" id="urlImage"><br>
        <label for="description">Description : </label>
        <input type="text" name="description" id="description"><br>
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
</body>