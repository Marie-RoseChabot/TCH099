<?php

require_once __DIR__.'/router.php';

// Routes statiques
get('/', 'index.php');
get('/index.php', 'index.php');
any('/login.php', 'login.php');
any('/register.php', 'register.php');

// Routes de l'API (statiques et dynamique)
get('/api/livres', '/api/livres/getLivres.php');
get('/api/categories', '/api/livres/getCategories.php');
get('/api/livres/$isbn', '/api/livres/getLivre.php');
put('/api/livres/$isbn', '/api/livres/putLivres.php');
post('/api/livres', '/api/livres/postLivre.php');


// Route introuvable
any('/404','404.php');
?>
