<?php

$router->get('/', 'controllers/index.php');
$router->get('/about', 'controllers/about.php');
$router->get('/contact', 'controllers/contact.php');

$router->get('/notes', 'controllers/notes/index.php')->only('auth');
$router->get('/note', 'controllers/notes/show.php');

$router->get('/note/edit', 'controllers/notes/edit.php');
$router->patch('/note', 'controllers/notes/update.php');

$router->delete('/note', 'controllers/notes/destroy.php');
$router->get('/notes/create', 'controllers/notes/create.php ');
$router->post('/notes', 'controllers/notes/store.php');

$router->get('/register', 'controllers/registration/create.php')->only('guest');
$router->post('/register', 'controllers/registration/store.php')->only('guest');

$router->get('/login', 'controllers/sessions/create.php')->only('guest');
$router->post('/sessions', 'controllers/sessions/store.php')->only('guest');
$router->delete('/sessions', 'controllers/sessions/destroy.php')->only('auth');
