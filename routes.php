<?php

require_once __DIR__.'/router.php';

// Routes statiques
any('/', 'index.php');
any('/index.php', 'index.php');
any('/login.php', 'login.php');
any('/register.php', 'register.php');
any('/demandeAjout.php', 'demandeAjout.php');
any('/portailEmploye.php', 'portailEmploye.php');

// Routes de l'API (statiques et dynamique)
get('/api/livres', '/api/livres/getLivres.php');
get('/api/auteur/$id','/api/livres/getAuteurs.php');
get('/api/livres/$isbn', '/api/livres/getLivre.php');
put('/api/livres/$isbn', '/api/livres/putLivres.php');
post('/api/Nouveaulivres', '/api/livres/postLivre.php');
get('/api/livresHistorique', '/api/livres/getLivresHistorique.php');
get('/api/nouveauLivre','/api/livres/getNouveauLivre.php');

get('/api/categories', '/api/livres/getCategorie.php');
get('/api/types', '/api/livres/getTypes.php');
get('/api/livres/$categorie/$type', '/api/livres/getLivresCatType.php');
post('/api/type', '/api/livres/postType.php');
post('/api/categorie', '/api/livres/postCategorie.php');

get('/api/recherche/$motCle','/api/livres/getLivresRecherches.php');

get('/api/email/$email','/api/livres/getNbEmail.php');
get('/api/user/$username','/api/livres/getNbUser.php');


get('/api/critique/$isbn','/api/livres/getCritiques.php');
get('/api/critiquesinsense','/api/livres/getCritiquesInsense.php');
put('/api/signalement/$isbn','/api/livres/putSignalement.php');
post('/api/critique','/api/livres/postCritique.php');

get('/api/copies/$isbn', '/api/livres/getCopie.php');
get('/api/typeCompte', '/api/livres/getTypeCompte.php');


post('/api/usager', '/api/livres/postUser.php');
post('/api/auth','/api/livres/auth.php');

post('/api/reserver','/api/livres/postReserver.php');


delete('/api/deleteLivre/$isbn' , '/api/livres/deleteLivre.php');
put('/api/Livre/$isbn' , '/api/livres/putLivre.php');


delete('/api/deleteCritiquesInsenses/$id' , '/api/livres/deleteCritiqueInsense.php');
put('/api/putCritiquesInsenses/$id' , '/api/livres/putCritiqueInsense.php');

// Route introuvable
any('/404','404.php');
?>
