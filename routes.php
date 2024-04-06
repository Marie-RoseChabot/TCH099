<?php

require_once __DIR__.'/router.php';

// Routes statiques
get('/', 'index.php');
get('/index.php', 'index.php');
any('/login.php', 'login.php');
any('/register.php', 'register.php');
any('/demandeAjout.php', 'demandeAjout.php');

// Routes de l'API (statiques et dynamique)
get('/api/livres', '/api/livres/getLivres.php');
get('/api/categories', '/api/livres/getCategorie.php');
get('/api/types', '/api/livres/getTypes.php');
get('/api/auteur/$id','/api/livres/getAuteurs.php');
get('/api/livres/$isbn', '/api/livres/getLivre.php');
get('/api/livres/$categorie/$type', '/api/livres/getLivresCatType.php');
get('/api/recherche/$motCle','/api/livres/getLivresRecherches.php');
get('/api/email/$email','/api/livres/getNbEmail.php');
get('/api/critique/$isbn','/api/livres/getCritiques.php');
get('/api/user/$username','/api/livres/getNbUser.php');
get('api/copies/$isbn', '/api/livres/getCopie.php');
put('/api/livres/$isbn', '/api/livres/putLivres.php');
put('/api/signalement/$isbn','/api/livres/putSignalement.php');
post('/api/livres', '/api/livres/postLivre.php');
post('/api/usager', '/api/livres/postUser.php');
post('/api/auth','/api/livres/auth.php');
get('/api/posts', '/api/livres/posts.php');

// Route introuvable
any('/404','404.php');
?>
