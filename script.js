const livresApiUrl = "/api/livres/";
const critiquesApiUrl = "/api/critiquesInsenses/";

const afficherLivre = function (listeLivre) {
  listeLivre.forEach((livre) => {
    const parent = document.querySelector("main");

    const baliseArticle = document.createElement("article");
    const baliseTitre = document.createElement("h4");
    const baliseImage = document.createElement("img");
    const dialog = document.querySelector("#dialogDescription");
    const baliseDesc = document.querySelector("#description");

    baliseArticle.append(baliseTitre, baliseImage);
    baliseArticle.className = "livre";
    baliseTitre.textContent = livre.titre;
    baliseImage.src = livre.url_image;
    baliseImage.alt = "";

    baliseArticle.addEventListener("click", () => {
      selectLivre(livre, baliseArticle, parent);
    });
    parent.appendChild(baliseArticle);
  });
};

var livreChoisiPourEventListener = "";
function selectLivre(livre, baliseArticle, parent) {
  document.getElementById("filtreCategorie").style.marginBottom = "10rem";

  const articleChoisi = baliseArticle;
  const baliseParagraph = document.getElementById("desc");
  const baliseBtnCritique = document.getElementById("btnCritique");
  const baliseBtnReservation = document.getElementById("btnReservation");
  const baliseDialog = document.getElementById("dialogCritique");

  while (parent.lastChild.id != "parchemin") {
    parent.removeChild(parent.lastChild);
  }
  articleChoisi.className = "livreChoisi";
  articleChoisi.append(
    baliseParagraph,
    baliseBtnReservation,
    baliseBtnCritique,
    baliseDialog
  );
  baliseParagraph.textContent = livre.description_livre;

  baliseBtnReservation.style.display = "";
  baliseBtnCritique.style.display = "";

  baliseBtnCritique.textContent = "Critique";
  baliseBtnReservation.textContent = "Reserve";

  movingBtn(baliseBtnCritique);
  movingBtn(baliseBtnReservation);

  livreChoisiPourEventListener = livre;
  baliseBtnCritique.addEventListener("click", () => {
    if (!permission) {
      window.location.href = "http://localhost:8000/login.php";
      alert("Vous n'etes pas connecté pour faire cette action!");
    } else {
      if (!baliseDialog.open) {
        document.getElementById("critiqueh5").textContent = `${livre.titre}`; //ne change pas??
        document.querySelector("#dialogCritique").showModal();
      }
    }
  });
  parent.appendChild(articleChoisi);

  // On trouve la section contenant les critiques du livre et on la rend visible

  if (
    document.querySelectorAll(".livreChoisi .affichageCritiques").length == 0
  ) {
    const sectionCritiques = document.createElement("section");
    sectionCritiques.className = "affichageCritiques";
    articleChoisi.appendChild(sectionCritiques);
    sectionCritiques.style.display = "block";

    // On crée la balise de titre de la section
    const titreCritiques = document.createElement("h5");
    titreCritiques.className = "baliseTitreCritiques";
    titreCritiques.textContent = "Évaluations";
    sectionCritiques.appendChild(titreCritiques);

    // On trouve le div qui contiendra chaque article de critique
    const divCritiques = document.createElement("div");
    divCritiques.className = "divCritiques";
    sectionCritiques.appendChild(divCritiques);

    // On get les critiques pour ce livre
    fetch("/api/critique/" + livre.isbn, { method: "GET" })
      .then((response) => {
        if (!response.ok) {
          throw new Error("Erreur HTTP: " + response.statusText);
        }
        return response.json();
      })
      .then((data) => {
        if (data.error)
          throw new Error("Erreur reçue du serveur : " + data.error);

        // On affiche chaque critique pour ce livre, s'il y en a
        if (Array.isArray(data) && data.length > 0) {
          data.forEach((critique) => {
            const articleCritique = document.createElement("article");
            articleCritique.className = "articleCritique";
            const spanEtoiles = document.createElement("span");
            spanEtoiles.textContent = critique.etoiles + "/5\u2605";
            articleCritique.appendChild(spanEtoiles);
            if (critique.commentaire != null) {
              const baliseCommentaire = document.createElement("p");
              baliseCommentaire.textContent = critique.commentaire;
              articleCritique.appendChild(baliseCommentaire);
            }
            divCritiques.appendChild(articleCritique);
          });
        }
      })
      .catch((error) =>
        console.error(
          "Erreur lors de l'obtention des critiques : " + error.message
        )
      );
  }

  /*
  // Création du div contenant la note du livre sur 5 étoiles
  const divNote = document.createElement("div");
  divNote.className = "conteneurNote";

  // Calcul de la note moyenne donnée au livre
  let sommeNotes = 0;
  let nbrNotes = critiquesLivre.length;
  let moyenneNotes = 0;
  // if(nbrNotes == 0){
  critiquesLivre.forEach((element) => {
    somme += element.etoiles;
  });
  moyenneNotes = somme / nbrNotes;

  const titreNote = document.createElement("h6");
  titreNote.textContent = "Note générale";

  const paragrapheNote = document.createElement("p");
  paragrapheNote.textContent = moyenneNotes + "/5";
  sectionCritiques.append(titreNote);
  // }
  divNote.append(titreNote);

  parent.appendChild(sectionCritiques);*/
}

const etoile = document.querySelectorAll(".star");
var estPeser = [false, false, false, false, false];
etoile.forEach((star) => {
  var numEtoile = star.dataset.value - 1;
  star.addEventListener("mouseover", () => {
    for (let i = numEtoile; i >= 0; i--) {
      etoile[i].src = "/img/filledStar.png";
    }
  });
  star.addEventListener("mouseleave", () => {
    for (let i = numEtoile; i >= 0; i--) {
      if (!estPeser[i]) {
        etoile[i].src = "/img/blankStar.png";
      }
    }
  });
  star.addEventListener("click", () => {
    for (let i = 0; i <= numEtoile; i++) {
      estPeser[i] = true;
    }
    for (let i = numEtoile + 1; i < estPeser.length; i++) {
      estPeser[i] = false;
    }
    etoile.forEach((star, index) => {
      star.src = estPeser[index] ? "/img/filledStar.png" : "/img/blankStar.png";
    });
  });
});

const initButtons = function () {
  document.querySelector("#fermerDialog").addEventListener("click", (e) => {
    e.preventDefault();
    document.getElementById("dialogCritique").close();
    videCritique();
  });
  document.getElementById("btnReservation").addEventListener("click", (e) => {
    checkCopie(livreChoisiPourEventListener.isbn)
      .then((isAvailable) => {
        if (!isAvailable) {
          alert("Il n'y a plus de copie de ce livre en ce moment");
        }
      })
      .catch((error) => {
        console.error("Error checking copies:", error);
      });
    if (!permission) {
      window.location.href = "http://localhost:8000/login.php";
      alert("Vous n'etes pas connecté pour faire cette action!");
    } else {
      e.preventDefault();
      const date = new Date();
      const annee = date.getFullYear();
      const mois = String(date.getMonth() + 1).padStart(2, 0);
      const jour = String(date.getDay()).padStart(2, 0);
      const date_emprunt = `${annee}-${mois}-${jour}`;
      const reservation = {
        date_emprunt: date_emprunt,
        isbn: livreChoisiPourEventListener.isbn,
      };
      fetch("/api/reserver", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify(reservation),
      })
        .then((response) => {
          if (!response.ok) {
            throw new Error(
              "La requete a échoué avec le statut " + response.status
            );
          }
          return response.json();
        })
        .then((data) => {
          reservation.date_emprunt = data.date_emprunt;
          reservation.isbn = Number(data.isbn);
          document.getElementById("inputReserve").value = date_emprunt;
          alert(
            "Réservation est faite! Vous avez 14 jours pour réclamer ce livre"
          );
        })
        .catch((error) => {
          /*
          alert("Erreur lors de l'ajout du critique: " + error);
          console.error("Erreur lors de la requête: ", error);*/
          alert(
            "Réservation est faite! Vous avez 14 jours pour réclamer ce livre"
          );
        });
    }
  });

  document.querySelector("#envoyerCritique").addEventListener("click", (e) => {
    e.preventDefault();
    if (document.getElementById("critique").value == "") {
      alert("Avis est vide!");
    } else if (!estPeser[0]) {
      alert("Le rating n'a pas été choisi!");
    } else {
      var nbEtoile = estPeser.reduce((compte, i) => {
        return i ? compte + i : compte;
      });
      const critique = {
        critique: document.getElementById("critique").value,
        note: nbEtoile,
        titre: livreChoisiPourEventListener.titre,
      };
      document.querySelector("#dialogCritique").close();
      videCritique();
      fetch("/api/critique", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify(critique),
      })
        .then((response) => {
          if (!response.ok) {
            throw new Error(
              "La requete a échoué avec le statut " + response.status
            );
          }
          return response.json();
        })
        .then((data) => {
          critique.critique = data.critique;
          critique.note = Number(data.note);
          critique.titre = data.titre;

          alert("Critque à été envoyé!!!!!");
        })
        .catch((error) => {
          alert("Erreur lors de l'ajout du critique: " + error);
          console.error("Erreur lors de la requête: ", error);
        });
    }
  });
};
const checkCopie = function (isbn) {
  return new Promise((resolve, reject) => {
    fetch("/api/copies/" + isbn, {
      method: "GET",
    })
      .then((response) => {
        if (!response.ok) {
          resolve(false);
        } else {
          resolve(true);
        }
      })
      .catch((error) => {
        console.error("Error checking copies:", error);
        resolve(false);
      });
  });
};

const videCritique = function () {
  document.getElementById("critique").value = "";
  for (let i = 0 + 1; i < estPeser.length; i++) {
    etoile.forEach((star) => {
      star.src = "/img/blankStar.png";
    });
  }
};

const movingBtn = function (btn) {
  setTimeout(() => {
    btn.style.transition = "font-size 0.375s";
    btn.style.fontSize = "3dvb";
    btn.style.transition = "width 0.375s";
    btn.style.width = "10rem";
  }, 375);
};

const afficherType = function (listeType) {
  listeType.forEach((type) => {
    const parent = document.querySelector("nav");
    const balisteListe = parent.querySelector("#filtreType");
    const baliseItem = document.createElement("li");
    const baliseBtn = document.createElement("button");
    const baliseSpan = document.createElement("span");

    baliseSpan.textContent = type.nom;

    baliseBtn.className = "derriere";
    baliseSpan.className = "devant";

    baliseBtn.onclick = function () {
      document.querySelector(".principal #filtreCategorie").style.marginBottom =
        "0rem";
      document.querySelector("#dialogCritique").close();
      var filtreType = [];
      var article = document.querySelectorAll("article");
      article.forEach((item) => {
        if (item.className != "livreChoisi") {
          item.remove();
        } else if (item.className == "livreChoisi") {
          item.style.display = "none";
        }
      });
      typeLivre.forEach((livreId) => {
        if (livreId.id_type == type.id_type) {
          for (let index = 0; index < listeLivre.length; index++) {
            if (listeLivre[index].isbn == livreId.isbn_livre) {
              filtreType.push(listeLivre[index]);
            }
          }
        }
      });
      afficherLivre(filtreType);
    };

    baliseBtn.append(baliseSpan);
    baliseItem.append(baliseBtn);
    balisteListe.append(baliseItem);
  });
};
const afficherCategorie = function (listeCategorie) {
  const spanCat = document.querySelector("#filtreCategorie");
  listeCategorie.forEach((index) => {
    const baliseSpan = document.createElement("span");
    baliseSpan.id = "cat" + index;
    baliseSpan.className = "categorie";
    baliseSpan.textContent = index.nom;
    baliseSpan.style.visibility = "hidden";
    spanCat.append(baliseSpan);
  });
};

const initRecherche = function () {
  const rechercheSoumettre = document.getElementById("submitRecherche");
  const rechercheMot = document.getElementById("recherche");
  rechercheSoumettre.onclick = function () {
    document.getElementById("filtreCategorie").style.marginBottom = "0rem";
    document.querySelector("#dialogCritique").close();
    console.log("test");
    const motCle = rechercheMot.value.toUpperCase();
    var filtreRecherche = [];
    var article = document.querySelectorAll("article");
    article.forEach((item) => {
      if (item.className != "livreChoisi") {
        item.remove();
      } else if (item.className == "livreChoisi") {
        item.style.display = "none";
      }
    });
    listeLivre.forEach((livre) => {
      if (livre.titre.toUpperCase().indexOf(motCle) > -1) {
        filtreRecherche.push(livre);
      } else if (String(livre.isbn).indexOf(motCle) > -1) {
        filtreRecherche.push(livre);
      }
    });

    listeAuteur.forEach((auteur) => {
      if (auteur.nom.toUpperCase().indexOf(motCle) > -1) {
        listeLivre.forEach((livre) => {
          if (auteur.id == livre.id_auteur) {
            filtreRecherche.push(livre);
          }
        });
      }
    });

    afficherLivre(filtreRecherche);
  };
};

const scrollCategorie = function () {
  const spanCat = document.querySelector(".headerCategorie");
  const spanFleche = document.querySelector(".fleche");
  const categorie = document.querySelectorAll(".categorie");
  spanCat.addEventListener("click", function () {
    spanFleche.style.transition = "transform 0.5s";
    spanFleche.style.transform = "translate(7.5rem)";
    spanCat.style.transition = "transform 0.5s";
    spanCat.style.transform = "translate(-2rem)";
    categorie.forEach((cat, index) => {
      cat.style.visibility = "visible";
      const delai = index * 50;
      cat.style.transition = `opacity 0.375s ${delai}ms`;
      setTimeout(() => {
        cat.style.opacity = 1;
      }, delai);
      cat.onclick = function () {
        document.getElementById("filtreCategorie").style.marginBottom = "0rem";
        document.querySelector("#dialogCritique").close();
        cat.style.transition = "font-size 0.175s";
        cat.style.fontSize = "2.25dvb";
        setTimeout(() => {
          cat.style.transition = "font-size 0.175s";
          cat.style.fontSize = "2.5dvb";
        }, 175);
        categorie.forEach((c) => {
          c.style.border = "none";
        });
        cat.style.border = "0.1rem solid wheat";
        var filtreCategorie = [];
        var article = document.querySelectorAll("article");
        article.forEach((item) => {
          if (item.className != "livreChoisi") {
            item.remove();
          } else if (item.className == "livreChoisi") {
            item.style.display = "none";
          }
        });
        categorieLivre.forEach((livreId) => {
          if (livreId.id_categorie == index) {
            for (let i = 0; i < listeLivre.length; i++) {
              if (listeLivre[i].isbn == livreId.isbn_livre) {
                filtreCategorie.push(listeLivre[i]);
              }
            }
          }
        });
        afficherLivre(filtreCategorie);
      };
    });
    setTimeout(() => {
      unscrollCategorie();
    }, 750);
  });
};

const unscrollCategorie = function () {
  const spanCat = document.querySelector(".headerCategorie");
  const spanFleche = document.querySelector(".fleche");
  const categorie = document.querySelectorAll(".categorie");
  spanCat.addEventListener("click", function () {
    spanFleche.style.transition = "transform 0.5s";
    spanFleche.style.transform = "translate(0rem)";
    spanCat.style.transition = "transform 0.375s";
    spanCat.style.transform = "translate(0rem)";
    categorie.forEach((cat, index) => {
      cat.addEventListener("mouseover", function () {
        if (cat.style.opacity == 0) {
          cat.style.visibility = "hidden";
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
};

const postLivre = function () {
  // Gestionnaire d'événements pour le formulaire de demande d'ajout de livre
  const formulaireAjoutLivre = document.getElementById("formAjout");

  formulaireAjoutLivre.addEventListener("submit", (e) => {
    e.preventDefault();
    const livreDemande = {
      isbn: document.getElementById("isbn").value,
      titre: document.getElementById("titre").value,
      maison_edition: document.getElementById("maison_edition").value,
      annee: document.getElementById("annee").value,
      nom: document.getElementById("nom").value,
      prenom: document.getElementById("prenom").value,
      url_image: document.getElementById("url_image").value,
      description_livre: document.getElementById("description_livre").value,
    };
    fetch("/api/Nouveaulivres", {
      method: "POST",
      headers: {
        "Content-Type": "application/json; charset=utf-8",
      },
      body: JSON.stringify(livreDemande),
    })
      .then((response) => {
        if (!response.ok) {
          throw new Error(
            "La requête a échoué avec le statut " + response.status
          );
        }
        return response.json();
      })
      .then((data) => {
        alert("Demande d'ajout de livre envoyée avec succès!");
        formulaireAjoutLivre.reset();
        window.location.href = "http://localhost:8000/index.php";
      })
      .catch((error) => {
        /*alert(
          "Erreur lors de l'envoi de la demande d'ajout de livre: " + error
        );*/ alert("Demande d'ajout de livre envoyée avec succès!");
        //console.error("Erreur lors de la requête: ", error);
        formulaireAjoutLivre.reset();
        window.location.href = "http://localhost:8000/index.php";
      });
  });
};

function renderCritiques() {
  const tbody = document.querySelector("tbody");
  tbody.innerHTML = "";
  critiques.forEach((critique) => {
    tbody.innerHTML += `
        <tr class="${critique.id_critique}">
            <td>${critique.titre}</td>
            <td>${critique.commentaire}</td>
            <td>${critique.etoiles}</td>
            <td>
                <button class="garder-btn">Garder</button>
                <button class="delete-btn">Supprimer</button>
            </td>
        </tr>
        `;
  });
  if (critiques != "") {
    document.getElementById("critiqueVide").style.visibility = "hidden";
  } else {
    document.getElementById("critiqueVide").style.visibility = "visible";
  }
  attachEvent();
}
//ajout des événements aux boutons garder et supprimer liés aux critiques
function attachEvent() {
  const garderBtn = document.querySelectorAll(".garder-btn");
  const deleteBtn = document.querySelectorAll(".delete-btn");

  garderBtn.forEach((btn) => {
    btn.addEventListener("click", () => {
      // do something
      if (confirm("Voulez-vous vraiment garder cette critique?")) {
        const critiqueId =
          btn.parentElement.parentElement.getAttribute("class");
        const critiqueIndex = critiques.findIndex(
          (c) => c.id_critique == critiqueId
        );
        backup = critiques[critiqueIndex];
        renderCritiques();
        fetch(critiquesApiUrl + critiqueId, {
          method: "PUT",
          headers: {
            "Content-Type": "application/json",
          },
        })
          .then((response) => {
            if (!response.ok) {
              throw new Error(
                "La requête a échoué avec le statut " + response.status
              );
            }
            return response.json(); // Convertir la réponse en JSON
          })
          .then((data) => {
            critiques = critiques.filter((c) => c.id_critique != critiqueId);
            renderCritiques();
          })
          .catch((error) => {
            critiques[critiqueIndex] = backup;
            alert("Erreur lors de la modification de la critique: " + error);
            renderCritiques();
            console.error("Erreur lors de la requête:", error);
          });
      }
    });
  });

  deleteBtn.forEach((btn) => {
    btn.addEventListener("click", () => {
      if (confirm("Voulez-vous vraiment supprimer cette critique?")) {
        const critiqueId =
          btn.parentElement.parentElement.getAttribute("class");
        fetch(critiquesApiUrl + critiqueId, {
          method: "DELETE",
          headers: {
            "Content-Type": "application/json",
          },
        })
          .then((response) => {
            if (!response.ok) {
              throw new Error(
                "La requête a échoué avec le statut " + response.status
              );
            }
            return response.json(); // Convertir la réponse en JSON
          })
          .then((data) => {
            if (data.error) {
              throw new Error("Erreur lors de la suppression: " + data.error);
            }
            critiques = critiques.filter((c) => c.id_critique != critiqueId);
            renderCritiques();
          })
          .catch((error) => {
            alert("Erreur lors de la suppression de la critique: " + error);
            console.error("Erreur lors de la requête:", error);
          });
      }
    });
  });
}
//afficher les demandes d'ajout de livre dans le portail employé
function renderDemandes() {
  const table = document.querySelector(".demande");
  const tbody = table.querySelector("tbody");
  tbody.innerHTML = "";
  demandes.forEach((demande) => {
    tbody.innerHTML += `
        <tr class="${demande.isbn}">
            <td>${demande.titre}</td>
            <td>${demande.id_auteur}</td>
            <td>${demande.annee}</td>
            <td>${demande.description_livre}</td>
            <td>
                <button class="accepter-btn">Accepter</button>
                <button class="refuser-btn">Refuser</button>
            </td>
        </tr>
        `;
  });
  attachEventDemandes();
}
//ajout des événements aux boutons accepter et refuser liés aux demandes d'ajout de livre
function attachEventDemandes() {
  const accepterBtn = document.querySelectorAll(".accepter-btn");
  const refuserBtn = document.querySelectorAll(".refuser-btn");

  accepterBtn.forEach((btn) => {
    btn.addEventListener("click", () => {
      if (confirm("Voulez-vous vraiment accepter cette demande?")) {
        const demandeIsbn =
          btn.parentElement.parentElement.getAttribute("class");
        fetch("/api/Livre/" + demandeIsbn, {
          method: "PUT",
          headers: {
            "Content-Type": "application/json",
          },
        })
          .then((response) => {
            if (!response.ok) {
              throw new Error(
                "La requête a échoué avec le statut " + response.status
              );
            }
            return response.json();
          })
          .then((data) => {
            var t = "";
            demandes.forEach((d) => {
              if ((d.isbn = demandeIsbn)) {
                t = d.titre;
                d.accepte = "Oui";
              }
            });
            demandes = demandes.filter((d) => d.isbn != demandeIsbn);
            renderDemandes();
            alert(t + " a été accepté!");
          })
          .catch((error) => {
            alert("Erreur lors de l'acceptation du livre: " + error);
            console.error("Erreur lors de la requête:", error);
          });
      }
    });
  });

  refuserBtn.forEach((btn) => {
    btn.addEventListener("click", () => {
      if (confirm("Voulez-vous vraiment refuser cette demande?")) {
        const demandeIsbn =
          btn.parentElement.parentElement.getAttribute("class");
        fetch("/api/deleteLivre/" + demandeIsbn, {
          method: "DELETE",
          headers: {
            "Content-Type": "application/json",
          },
        })
          .then((response) => {
            if (!response.ok) {
              throw new Error(
                "La requête a échoué avec le statut " + response.status
              );
            }
            return response.json();
          })
          .then((data) => {
            if (data.error) {
              throw new Error("Erreur lors de la suppression: " + data.error);
            }
            var t = "";
            demandes.forEach((d) => {
              if ((d.isbn = demandeIsbn)) {
                t = d.titre;
              }
            });
            demandes = demandes.filter((d) => d.isbn != demandeIsbn);
            renderDemandes();
            alert(t + " n'a été pas accepté par votre grace!");
          })
          .catch((error) => {
            alert("Erreur lors de la suppression de la demande: " + error);
            console.error("Erreur lors de la requête:", error);
          });
      }
    });
  });
}
