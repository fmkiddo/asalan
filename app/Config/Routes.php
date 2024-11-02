<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->match (['get', 'post'], '/', 'Home::index');
$routes->match (['get', 'post'], '/{locale}', 'Home::index');
$routes->match (['get', 'post'], '/{locale}/dashboard', 'Home::index');
$routes->match (['get', 'post'], '/{locale}/change-config', 'Home::configChanger');
$routes->match (['get', 'post'], '/{locale}/welcome', 'Welcome::index');

$routes->group ('osam', static function ($routes) {
    $routes->match (['get', 'post'], 'setup', 'SetupSystem::index');
});