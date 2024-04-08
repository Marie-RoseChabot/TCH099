const livresApiUrl = "/api/livres/";

let numArticle = 0;
const afficherLivre = function(listeLivre) {
    listeLivre.forEach((livre) => {
        const parent = document.querySelector('main');
        const baliseArticle = document.createElement('article');
        const baliseTitre = document.createElement('h4');
        const baliseImage = document.createElement('img');
        const dialog = document.querySelector('#dialogDescription');
        const baliseDesc = document.querySelector('#description');
        const baliseA = document.createElement('a');

        baliseArticle.append(baliseTitre, baliseImage, baliseA);
        baliseA.href = livre.isbn;//fonctionne pas
        baliseArticle.className = 'livre';
        baliseTitre.textContent = livre.titre;
        baliseImage.src = livre.url_image;
        baliseImage.alt = "";

        baliseArticle.addEventListener('click', function() {
            const articleChoisI = baliseArticle;
            const baliseParagraph = document.createElement('p');
            const baliseCritique = document.createElement('dialog');
            const baliseBtnReserver = document.createElement('button');
            const baliseBtnCritique = document.createElement('button');

            while (parent.lastChild.id != 'parchemin') {
                parent.removeChild(parent.lastChild);
            }
            articleChoisI.className = 'livreChoisi';
            baliseArticle.append(baliseParagraph, baliseBtnCritique, baliseBtnReserver, baliseCritique);
            baliseParagraph.textContent = livre.description_livre;
            baliseBtnReserver.id = 'reservation';
            baliseBtnReserver.textContent = 'Réserver';
            baliseBtnReserver.className = 'btnLivreChoisi';
            baliseBtnCritique.id = 'btnCritique';
            baliseBtnCritique.textContent = 'Critiquer';
            baliseBtnCritique.className = 'btnLivreChoisi';
            baliseCritique.id = 'critique';

            parent.appendChild(articleChoisI);
            
        });
        parent.appendChild(baliseArticle);
    })
}

const mouseoverBtn = function(btn) {
    btn.addEventListener('mouseover', function() {
        
    });
}

const afficherType = function(listeType) {
    listeType.forEach((type) => {
        const parent = document.querySelector('nav');
        const balisteListe = parent.querySelector('#filtreType');
        const baliseItem = document.createElement('li');
        const baliseBtn = document.createElement('button');
        const baliseSpan = document.createElement('span');

        baliseSpan.textContent = type.nom;

        baliseBtn.className = 'derriere';
        baliseSpan.className = 'devant';
        
        baliseBtn.onclick = function() {
            var filtreType = [];
            var article = document.querySelectorAll('article');
            article.forEach((item) => {
                item.remove();
            })
            typeLivre.forEach((livreId) => {
                if(livreId.id_type == type.id_type) {
                    for (let index = 0; index < listeLivre.length; index++) {
                        if (listeLivre[index].isbn == livreId.isbn_livre) {
                            filtreType.push(listeLivre[index]);
                        }
                    }
                }
            })
            afficherLivre(filtreType);
        }

        baliseBtn.append(baliseSpan);
        baliseItem.append(baliseBtn);
        balisteListe.append(baliseItem);
    })
}
const afficherCategorie = function(listeCategorie) {
    const spanCat = document.querySelector('#filtreCategorie');
    listeCategorie.forEach((index) => {
        const baliseSpan = document.createElement('span');
        baliseSpan.id = 'cat'+index;
        baliseSpan.className = 'categorie';
        baliseSpan.textContent = index.nom;
        baliseSpan.style.visibility = 'hidden';
        spanCat.append(baliseSpan);
    });
}

const rechercheSoumettre = document.getElementById('submitRecherche');
const rechercheMot = document.getElementById("recherche");
rechercheSoumettre.onclick = function() {
    console.log("test");
    const motCle = rechercheMot.value.toUpperCase();
    var filtreRecherche = [];
    var article = document.querySelectorAll('article');
    article.forEach((item) => {
        item.remove();
    })
    listeLivre.forEach((livre) => {
        if (livre.titre.toUpperCase().indexOf(motCle) > -1) {
            filtreRecherche.push(livre);
        } else if (String(livre.isbn).indexOf(motCle) > -1) {
            filtreRecherche.push(livre);
        }
    })

    listeAuteur.forEach((auteur) => {
        if(auteur.nom.toUpperCase().indexOf(motCle) > -1) {
            listeLivre.forEach((livre) => {
                if(auteur.id == livre.id_auteur) {
                    filtreRecherche.push(livre);
                }
            })
        }
    })

    afficherLivre(filtreRecherche);
}
var clicked = [];
const scrollCategorie = function() {
    const spanCat = document.querySelector('.headerCategorie');
    const spanFleche = document.querySelector('.fleche');
    const categorie = document.querySelectorAll('.categorie');
    spanCat.addEventListener('click', function() {
        spanFleche.style.transition = 'transform 0.5s';
        spanFleche.style.transform = 'translate(7.5rem)';
        spanCat.style.transition = 'transform 0.5s';
        spanCat.style.transform = 'translate(-2rem)';
        categorie.forEach((cat, index) => {
            cat.style.visibility = 'visible';
            const delai = index * 50;
            cat.style.transition = `opacity 0.375s ${delai}ms`;
            setTimeout(() => {
                cat.style.opacity = 1;
            }, delai);
            cat.onclick = function() {
                cat.style.transition = 'font-size 0.175s';
                cat.style.fontSize = '2.25dvb';
                setTimeout(() => {
                    cat.style.transition = 'font-size 0.175s';
                    cat.style.fontSize = '2.5dvb';
                }, 175);
                categorie.forEach((c) => {
                    c.style.border = 'none';
                });
                cat.style.border = '0.1rem solid wheat';
                var filtreCategorie = [];
                var article = document.querySelectorAll('article');
                article.forEach((item) => {
                    item.remove();
                })
                categorieLivre.forEach((livreId) => {
                    if(livreId.id_categorie == index+1) {
                        for (let i = 0; i < listeLivre.length; i++) {
                            if (listeLivre[i].isbn == livreId.isbn_livre) {
                                filtreCategorie.push(listeLivre[i]);
                        }
                        }
                    }
                })
                afficherLivre(filtreCategorie);
            }
        });
        setTimeout(() => {
            unscrollCategorie();
        }, 750);
    });
}

const unscrollCategorie = function() {
    const spanCat = document.querySelector('.headerCategorie');
    const spanFleche = document.querySelector('.fleche');
    const categorie = document.querySelectorAll('.categorie');
    spanCat.addEventListener('click', function() {
        spanFleche.style.transition = 'transform 0.5s';
        spanFleche.style.transform = 'translate(0rem)';
        spanCat.style.transition = 'transform 0.375s';
        spanCat.style.transform = 'translate(0rem)';
        categorie.forEach((cat, index) => {
            cat.addEventListener('mouseover', function() {
                if (cat.style.opacity == 0) {
                    cat.style.visibility = 'hidden';
                }
            });
            const delai = index * 50;
            cat.style.transition = `opacity 0.50s ${delai}ms`;
            setTimeout(() => {
                cat.style.opacity = 0;
            }, delai);
        });
        setTimeout(() => {
            scrollCategorie();
        }, 750);
    });
}