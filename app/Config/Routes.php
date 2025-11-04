<?php

/**
 * @var CodeIgniter\Router\RouteCollection $routes
 */

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Books');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();

// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// Books routes
$routes->get('/', 'Books::index');
$routes->get('/books', 'Books::index');
$routes->get('/books/create', 'Books::create');
$routes->post('/books/store', 'Books::store');
$routes->get('/books/edit/(:num)', 'Books::edit/$1');
$routes->post('/books/update/(:num)', 'Books::update/$1');
$routes->get('/books/delete/(:num)', 'Books::delete/$1');


