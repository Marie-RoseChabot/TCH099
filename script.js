var listeLivre = [
    {
    "titre" : "Harry Potter à l'école des sorciers",
    "urlImage" : "https://m.media-amazon.com/images/I/516qWQcG3FL.jpg",
    "categorie" : "Romans"
    },
    {
    "titre" : "Tintin au Congo",
    "urlImage" : "https://m.media-amazon.com/images/I/61Ergcdo5NL._AC_UF1000,1000_QL80_.jpg",
    "categorie" : "Philosophie"
    },
    {
    "titre" : "Le Seigneur des Anneaux : La communauté de l'Anneau",
    "urlImage" : "https://www.gallimardmontreal.com/system/articles/images/grand/9782266107983.jpg",
    "categorie" : "Philosophie"
    },
    {
    "titre" : "Le Petit Prince",
    "urlImage" : "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTRUmdhsYTRKcUZIWeZalepg8Hv4m03wMHnWA&usqp=CAU",
    "categorie" : "Philosophie"
    },
    {
    "titre" : "Orgueil et Préjugés",
    "urlImage" : "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRSE7To1NYv9vIQDXe3Py2Ji4B-d0J9J8R12w&usqp=CAU",
    "categorie" : "Philosophie"
    },
    {
    "titre" : "1984",
    "urlImage" : "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSsc3GiO3O4clyHm3TfXypE3U1K9vlLZDYw1g&usqp=CAU",
    "categorie" : "Philosophie"
    },
    {
    "titre" : "Le Hobbit",
    "urlImage" : "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRSB2yqM8df3Mq8ZCPx51mYM3YUVbIYU2PDVbCzYoSP23HmcLwyJboblvw3xl481o7HHxQ&usqp=CAU",
    "categorie" : "Philosophie"
    },
    {
    "titre" : "Les Misérables",
    "urlImage" : "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ2Jkwp31A1LQ7U-cXfEUuMGFDBbsP3l6AxUw&usqp=CAU",
    "categorie" : "Philosophie"
    },
    {
    "titre" : "L'Alchimiste",
    "urlImage" : "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT16SUZ0VJPaN0NDp0_L3EsM7tu1_asO0JWrA&usqp=CAU",
    "categorie" : "Philosophie"
    },
    {
    "titre" : "Discours de la méthode",
    "urlImage" : "https://m.media-amazon.com/images/I/61njB87x6-L._SY425_.jpg",
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
        const baliseBtn = document.createElement('button');
        const baliseSpan = document.createElement('span');

        baliseSpan.textContent = categorie;
        baliseSpan.href = "?"+categorie;

        baliseBtn.className = 'derriere';
        baliseSpan.className = 'devant';
        
        baliseBtn.append(baliseSpan);
        baliseItem.append(baliseBtn);
        balisteListe.append(baliseItem);
    })
}

afficherLivre(listeLivre);
afficherType(listeType);
afficherCategorie(listeCategorie);