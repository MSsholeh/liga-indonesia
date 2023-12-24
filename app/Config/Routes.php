<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('/clubs', 'Club::index');
$routes->add('/club/store', 'Club::store');
$routes->add('/club/(:segment)/edit', 'Club::edit/$1');
$routes->get('/club/(:segment)/delete', 'Club::delete/$1');

$routes->get('/players', 'Player::index');
$routes->add('/player/store', 'Player::store');
$routes->add('/player/(:segment)/edit', 'Player::edit/$1');
$routes->get('/player/(:segment)/delete', 'Player::delete/$1');
