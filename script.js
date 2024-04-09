const livresApiUrl = "/api/livres/";

const afficherLivre = function(listeLivre) {
    listeLivre.forEach((livre) => {
        const parent = document.querySelector('main');
        const baliseArticle = document.createElement('article');
        const baliseTitre = document.createElement('h4');
        const baliseImage = document.createElement('img');
        const dialog = document.querySelector('#dialogDescription');
        const baliseDesc = document.querySelector('#description');

        baliseArticle.append(baliseTitre, baliseImage);
        baliseArticle.className = 'livre';
        baliseTitre.textContent = livre.titre;
        baliseImage.src = livre.url_image;
        baliseImage.alt = "";

        baliseArticle.addEventListener('click', () => {
            selectLivre(livre, baliseArticle, parent);            
        });
        parent.appendChild(baliseArticle);
    })
}

function selectLivre(livre, baliseArticle, parent) {
    document.getElementById('filtreCategorie').style.marginBottom = '10rem';

        const articleChoisi = baliseArticle;
        const baliseParagraph = document.getElementById('desc');
        const baliseBtnCritique = document.getElementById('btnCritique');
        const baliseBtnReservation = document.getElementById('btnReservation');
        const baliseDialog = document.getElementById('dialogCritique');

        while (parent.lastChild.id != 'parchemin') {
            parent.removeChild(parent.lastChild);
        }
        articleChoisi.className = 'livreChoisi';
        articleChoisi.append(baliseParagraph, baliseBtnReservation, baliseBtnCritique, baliseDialog);
        baliseParagraph.textContent = livre.description_livre;

        baliseBtnReservation.style.display = '';
        baliseBtnCritique.style.display = '';

        baliseBtnCritique.textContent = 'Critique';
        baliseBtnReservation.textContent = 'Reserve';
    
        movingBtn(baliseBtnCritique);
        movingBtn(baliseBtnReservation);

        baliseBtnReservation.addEventListener('click', () => {
            //affFiche('reservation', livre);
        });
        baliseBtnCritique.addEventListener('click', () => {
            if (!baliseDialog.open) {
                //affFiche('critique', livre);
                document.getElementById('critiqueh5').textContent = `${livre.titre}`;//ne change pas??
                document.querySelector('#dialogCritique').showModal();
            }               
        });
        parent.appendChild(articleChoisi);
}

const etoile = document.querySelectorAll('.star');
var estPeser = [false, false, false, false, false];
etoile.forEach((star) => {
    var numEtoile = star.dataset.value-1;
    star.addEventListener('mouseover', () => {
        for (let i = numEtoile; i >= 0; i--) {
            etoile[i].src = '/img/filledStar.png';
        }
    });
    star.addEventListener('mouseleave', () => {
        for (let i = numEtoile; i >= 0; i--) {
            if (!estPeser[i]) {
                etoile[i].src = '/img/blankStar.png';
            }
        }
    });
    star.addEventListener('click', () => {
        for (let i = 0; i <= numEtoile; i++) {
            estPeser[i] = true;
        }
        for (let i = numEtoile + 1; i < estPeser.length; i++) {
            estPeser[i] = false;
        }
        etoile.forEach((star, index) => {
            star.src = estPeser[index] ? '/img/filledStar.png' : '/img/blankStar.png';
        });
    });
});

document.querySelector('#fermerDialog').addEventListener('click', (e) => {
    e.preventDefault();
    document.getElementById('dialogCritique').close();
    videCritique();
});

document.querySelector('#envoyerCritique').addEventListener('click', (e) => {
    e.preventDefault();
    if (document.getElementById('avis').value == '') {
        alert("Avis est vide!");
    } else if (!estPeser[0]) {
        alert("Le rating n'a pas été choisi!");
    } else {
        var nbEtoile = estPeser.reduce((compte, i) => {
                        return i ? compte + i : compte;
                        });
        const critique = {'commentaire': document.getElementById('avis').value, 'etoiles': nbEtoile};
        document.querySelector('#dialogCritique').close();
        videCritique();
        fetch('/api/critiques', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
            body: JSON.stringify(critique)
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('La requete a échoué avec le statut ' + response.status);
            }
            return response.json();
        })
        .then(data => {
            critique.commentaire = data.commentaire;
            critique.etoiles = Number(data.etoiles);
            etoile.forEach((s, i) => {
                if (estPeser[i]) {
                    s.dataset.on = 'on';
                    document.getElementById('inputEtoile').value = i;
                }
            });
            alert("Critque à été envoyé!!!!!")
        })
        .catch(error =>{
            alert("Erreur lors de l'ajout du critique: " + error);
            console.error('Erreur lors de la requête: ', error);
        })
    }
});

const videCritique = function() {
    document.getElementById('avis').value = '';
    for (let i = 0 + 1; i < estPeser.length; i++) {
        etoile.forEach((star) => {
            star.src = '/img/blankStar.png';
        });
    }
}
/*
const affFiche = function(fiche, livre) {
    switch(fiche) {
        case 'reservation':
            // Handle reservation case
            break;
        case 'critique':
            //do the api send to db here..!!
            break;
        default:
            break;
    }
}*/

const movingBtn = function(btn) {
    setTimeout(() => {
        btn.style.transition = 'font-size 0.375s';
        btn.style.fontSize = '3dvb';
        btn.style.transition = 'width 0.375s';
        btn.style.width = '10rem';
    }, 375);
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
            document.querySelector('.principal #filtreCategorie').style.marginBottom = '0rem';
            document.querySelector('#dialogCritique').close();
            var filtreType = [];
            var article = document.querySelectorAll('article');
            article.forEach((item) => {
                if (item.className != 'livreChoisi') {
                    item.remove();
                } else if (item.className == 'livreChoisi') {
                    item.style.display = 'none';
                }
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
    document.getElementById('filtreCategorie').style.marginBottom = '0rem';
    document.querySelector('#dialogCritique').close();
    console.log("test");
    const motCle = rechercheMot.value.toUpperCase();
    var filtreRecherche = [];
    var article = document.querySelectorAll('article');
    article.forEach((item) => {
        if (item.className != 'livreChoisi') {
            item.remove();
        } else if (item.className == 'livreChoisi') {
            item.style.display = 'none';
        }
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
                document.getElementById('filtreCategorie').style.marginBottom = '0rem';
                document.querySelector('#dialogCritique').close();
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
                    if (item.className != 'livreChoisi') {
                        item.remove();
                    } else if (item.className == 'livreChoisi') {
                        item.style.display = 'none';
                    }
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
/*const isbn = livre.isbn;

            fetch(livresApiUrl+isbn, {
                method: 'GET'
            })
            .then(response => {
                if (!response.ok) {
                  throw new Error('Network response was not ok');
                }
                return response.text();
            })
            .then(data => {
                console.log(data);
            })
            .catch(error => {
                console.error('There was a problem with the fetch operation:', error);
            });*/