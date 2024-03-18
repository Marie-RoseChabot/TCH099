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

const afficherLivre = function(listeLivre) {
    listeLivre.forEach((livre) => {
        const parent = document.querySelector('main');
        const baliseArticle = document.createElement('article');
        const baliseTitre = document.createElement('h4');
        const baliseImage = document.createElement('img');

        baliseArticle.append(baliseTitre, baliseImage);
        baliseTitre.textContent = livre.titre;
        baliseImage.src = livre.urlImage;
        baliseImage.alt = "Harry Potter";
        parent.appendChild(baliseArticle);
    })

}

afficherLivre(listeLivre);