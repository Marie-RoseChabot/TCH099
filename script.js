var listeLivre = [
    {
    "titre" : "Harry Potter à l'école des sorciers",
    "auteur" : "J. K. Rowling",
    "urlImage" : "https://m.media-amazon.com/images/I/516qWQcG3FL.jpg",
    "type" : "Romans",
    "categorie" : "Fantastique"
    },
    {
    "titre" : "Tintin au Congo",
    "auteur" : "Hergé",
    "urlImage" : "https://m.media-amazon.com/images/I/61Ergcdo5NL._AC_UF1000,1000_QL80_.jpg",
    "type" : "Bande dessinée",
    "categorie" : "Aventure"

    },
    {
    "titre" : "Le Seigneur des Anneaux : La communauté de l'Anneau",
    "auteur" : "John Ronald Reuel Tolkien",
    "urlImage" : "https://www.gallimardmontreal.com/system/articles/images/grand/9782266107983.jpg",
    "type" : "Romans",
    "categorie" : "Fantastique"
    },
    {
    "titre" : "Le Petit Prince",
    "auteur" : "Antoine de Saint-Exupéry",
    "urlImage" : "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTRUmdhsYTRKcUZIWeZalepg8Hv4m03wMHnWA&usqp=CAU",
    "type" : "Romans",
    "categorie" : "Enfant"
    },
    {
    "titre" : "Orgueil et Préjugés",
    "auteur" : "Jane Austen",
    "urlImage" : "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRSE7To1NYv9vIQDXe3Py2Ji4B-d0J9J8R12w&usqp=CAU",
    "type" : "Romans",
    "categorie" : "Romance"
    },
    {
    "titre" : "1984",
    "auteur" : "Geroge Orwell",
    "urlImage" : "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSsc3GiO3O4clyHm3TfXypE3U1K9vlLZDYw1g&usqp=CAU",
    "type" : "Romans",
    "categorie" : "Science-Fiction"
    },
    {
    "titre" : "Le Hobbit",
    "auteur" : "John Ronald Reuel Tolkien",
    "urlImage" : "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRSB2yqM8df3Mq8ZCPx51mYM3YUVbIYU2PDVbCzYoSP23HmcLwyJboblvw3xl481o7HHxQ&usqp=CAU",
    "type" : "Romans",
    "categorie" : "Fantastique"
    },
    {
    "titre" : "Les Misérables",
    "auteur" : "Victor Hugo",
    "urlImage" : "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ2Jkwp31A1LQ7U-cXfEUuMGFDBbsP3l6AxUw&usqp=CAU",
    "type" : "Romans",
    "categorie" : "Aventure"
    },
    {
    "titre" : "L'Alchimiste",
    "auteur" : "Paulo Coelho",
    "urlImage" : "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT16SUZ0VJPaN0NDp0_L3EsM7tu1_asO0JWrA&usqp=CAU",
    "type" : "Philosophie",
    "categorie" : "Aventure"
    },
    {
    "titre" : "Discours de la méthode",
    "auteur" : "René Descartes",
    "urlImage" : "https://m.media-amazon.com/images/I/61njB87x6-L._SY425_.jpg",
    "type" : "Essais",
    "categorie" : "Philosophie"
    }]

var listeType = ["Albums","Bande dessinée", "Contes", "Documentaire", "Essais", "Journaux",
                        "Magazines", "Mangas", "Nouvelles", "Philosophie", "Poésie", "Romans"]

var listeCategorie = ["Aventure", "Biographie", "Enfant", "Fantastique", "Histoire", "Policier", "Romance", "Science-Fiction"]

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
        const parent = document.querySelector('nav');
        const balisteListe = parent.querySelector('#filtreType');
        const baliseItem = document.createElement('li');
        const baliseBtn = document.createElement('button');
        const baliseSpan = document.createElement('span');

        baliseSpan.textContent = type;

        baliseBtn.className = 'derriere';
        baliseSpan.className = 'devant';
        
        baliseBtn.onclick = function() {
            var filtreCategorie = [];
            var article = document.querySelectorAll('article');
            article.forEach((item) => {
                item.remove();
            })
            listeLivre.forEach((livre) => {
                if(livre.type == type) {
                    filtreCategorie.push(livre);
                }
            })
            afficherLivre(filtreCategorie);
        }

        baliseBtn.append(baliseSpan);
        baliseItem.append(baliseBtn);
        balisteListe.append(baliseItem);
    })
}
const changerCategorie = function() {
    const spanCat = document.querySelector('#filtreCategorie');
    spanCat.textContent = listeCategorie[Math.floor(Math.random() * listeCategorie.length)];
}

const afficherCategorie = function(listeCategorie) {
    listeCategorie.forEach((categorie) => {
        const parent = document.querySelector('nav')
        const balisteListe = parent.querySelector('#filtreCategorie');
        const baliseItem = document.createElement('li');
        const baliseBtn = document.createElement('button');
        const baliseSpan = document.createElement('span');

        baliseSpan.textContent = categorie;

        baliseBtn.className = 'derriere';
        baliseSpan.className = 'devant';

        baliseBtn.onclick = function() {
            var filtreType = [];
            var article = document.querySelectorAll('article');
            article.forEach((item) => {
                item.remove();
            })
            listeLivre.forEach((livre) => {
                if(livre.categorie == categorie) {
                    filtreType.push(livre);
                }
            })
            afficherLivre(filtreType);
        }
        
        baliseBtn.append(baliseSpan);
        baliseItem.append(baliseBtn);
        balisteListe.append(baliseItem);
    })
}

const rechercheSoumettre = document.getElementById('submitRecherche');
const rechercheMot = document.getElementById("recherche");
rechercheSoumettre.onclick = function() {
    const motCle = rechercheMot.value.toUpperCase();
    console.log(motCle);
    var filtreType = [];
    var article = document.querySelectorAll('article');
    article.forEach((item) => {
        item.remove();
    })
    listeLivre.forEach((livre) => {
        if(livre.titre.toUpperCase().indexOf(motCle) > -1 || livre.auteur.toUpperCase().indexOf(motCle) > -1) {
            filtreType.push(livre);
        }
    })
    afficherLivre(filtreType);
}

const attachListerner = function() {
    const spanCat = document.querySelector('#filtreCategorie');
    spanCat.addEventListener('click', function() {
        changerCategorie();
    });
}

//attachListerner();
afficherLivre(listeLivre);
afficherType(listeType);
afficherCategorie(listeCategorie);