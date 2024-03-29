<!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>Ajout de livre</title>
</head>
<body>
    <form action="./" id="formAjout">
        <label for="isbn">ISBN : </label>
        <input type="text" name="isbn" id="isbn"><br>
        <label for="titre">Titre : </label>
        <input type="text" name="titre" id="titre"><br>
        <label for="auteur">Auteur : </label>
        <input type="text" name="auteur" id="auteur"><br>
        <label for="urlImage">Image du livre : </label>
        <input type="text" name="urlImage" id="urlImage"><br>
        <label for="type">Type : </label>
        <select name="type" id="type">
            <option value="">Veuillez choisir une catégorie</option>
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
        <select name="categorie" id="categorie">
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
        <button type="submit" id="soumettre">Soumettre</button>
        <button type="reset" id="restart">Recommencer</button>
        <button type="button" id="quit">Quitter</button>
    </form>
</body>