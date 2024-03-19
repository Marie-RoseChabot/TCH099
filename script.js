var listeLivre = [
    {
    "titre" : "Harry Potter à l'école des sorciers",
    "urlImage" : "https://m.media-amazon.com/images/I/516qWQcG3FL.jpg",
    "categorie" : "Romans"
    },
    {
    "titre" : "Descartes",
    "urlImage" : "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTwGyB9GoEk4AvaLeC5u37KyozJBbWayiEnTxtCK9xf&s",
    "categorie" : "Philosophie"
    }]

var listeType = ["Albums","Bande dessinée", "Contes", "Documentaire", "Journaux",
                        "Magazines", "Mangas", "Nouvelles", "Philosophie", "Poésie", "Romans"]

var listeCategorie = ["Aventure", "Biographie", "Fantastique", "Histoire", "Policier", "Romance", "Science-Fiction"]

const afficherLivre = function(listeLivre) {
    listeLivre.forEach((livre) => {
        const parent = document.querySelector('main');
        const baliseArticle = document.createElement('article');
        const baliseTitre = document.createElement('h4');
        const baliseImage = document.createElement('img');

        baliseArticle.append(baliseTitre, baliseImage);
        baliseTitre.textContent = livre.titre;
        baliseImage.src = livre.urlImage;
        baliseImage.alt = "";
        parent.appendChild(baliseArticle);
    })
}

const afficherType = function(listeType) {
    listeType.forEach((type) => {
        const parent = document.querySelector('nav')
        const balisteListe = parent.querySelector('#filtreType');
        const baliseItem = document.createElement('li');
        const baliseNom = document.createElement('a');

        baliseNom.textContent = type;
        baliseNom.href = "?"+type;
        
        baliseItem.append(baliseNom);
        balisteListe.append(baliseItem);
    })
}

const afficherCategorie = function(listeCategorie) {
    listeCategorie.forEach((categorie) => {
        const parent = document.querySelector('nav')
        const balisteListe = parent.querySelector('#filtreCategorie');
        const baliseItem = document.createElement('li');
        const baliseNom = document.createElement('a');

        baliseNom.textContent = categorie;
        baliseNom.href = "?"+categorie;
        
        baliseItem.append(baliseNom);
        balisteListe.append(baliseItem);
    })
}

afficherLivre(listeLivre);
afficherType(listeType);
afficherCategorie(listeCategorie);